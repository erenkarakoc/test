<?php
namespace App\Http\Controllers\Blockchains;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TransactionController;
use App\Models\Blockchains\GeneratedTronWallet;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserBalances;
use App\Services\UserBalancesService;
use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;
use Illuminate\Support\Facades\View;

class TronApiController extends Controller {
    protected $client;

    protected $fullNode;

    protected $solidityNode;

    protected $eventServer;

    protected $tron;

    public function __construct() {
        parent::__construct();
        $this->fullNode     = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
        $this->solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
        $this->tron         = new \IEXBase\TronAPI\Tron($this->fullNode, $this->solidityNode, $this->eventServer);
        $this->client       = new \GuzzleHttp\Client();
    }

    public function generateTronWalletForUser($user_id) {
        $generatedWallet = $this->tron->createAccount();

        $renderer = new GDLibRenderer(130);
        $writer   = new Writer($renderer);
        $qr_code  = base64_encode($writer->writeString($generatedWallet->getAddress(true)));

        $wallet = [
            'user_id'        => $user_id,
            'trx_balance'    => 0,
            'usdt_balance'   => 0,
            'private_key'    => $generatedWallet->getPrivateKey(),
            'public_key'     => $generatedWallet->getPublicKey(),
            'address_hex'    => $generatedWallet->getAddress(true),
            'address_base58' => $generatedWallet->getAddress(),
            'qr_code'        => $qr_code,
        ];

        GeneratedTronWallet::create($wallet);
    }

    public function sendTrxFundsRequest($userId, $amount, $recipientAddress) {
        try {
            $senderWallet = GeneratedTronWallet::where('user_id', $userId)->first();
            if (! $senderWallet) {
                throw new \Exception('Sender wallet not found');
            }

            // Create unsigned transaction
            $transaction = $this->createTransaction($senderWallet->address_hex, $recipientAddress, $amount);

            // Calculate fee
            $fee = $this->calculateTrxTransactionFee($transaction);

            // Validate total amount (amount + fee) against balance
            $totalRequired = $amount + $fee;
            $balance       = $this->tron->getBalance($senderWallet->address_hex) / 1000000; // Convert from SUN to TRX

            if ($balance < $totalRequired) {
                throw new \Exception('Insufficient balance including fee. Required: ' . $totalRequired . ' TRX, Available: ' . $balance . ' TRX');
            }

            return [
                'fee'            => $fee,
                'transaction'    => $transaction,
                'total_required' => $totalRequired,
                'balance'        => $balance,
            ];
        } catch (\Exception $e) {
            throw new \Exception('Failed to create transaction: ' . $e->getMessage());
        }
    }

    private function createTransaction($senderAddress, $recipientAddress, $amount) {
        $response = $this->client->post('https://api.shasta.trongrid.io/wallet/createtransaction', [
            'json'    => [
                'owner_address' => $this->tron->toHex($senderAddress),
                'to_address'    => $this->tron->toHex($recipientAddress),
                'amount'        => (int) round($amount * 1000000),
            ],
            'headers' => [
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    private function calculateTrxTransactionFee($transaction) {
        try {
            $senderAddress = $transaction['raw_data']['contract'][0]['parameter']['value']['owner_address'];

                                                                                          // 1. Calculate total transaction size (including signature)
            $transactionSizeInBytes = strlen(hex2bin($transaction['raw_data_hex'])) + 64; // 64 bytes for signature

            // 2. Fetch account resources
            $response = $this->client->post('https://api.shasta.trongrid.io/wallet/getaccountresource', [
                'json' => [
                    'address' => $senderAddress,
                ],
            ]);
            $accountResources = json_decode($response->getBody(), true);

                                                                       // 3. Calculate available bandwidth
            $freeNetLimit = $accountResources['freeNetLimit'] ?? 1500; // Default daily free bandwidth
            $freeNetUsed  = $accountResources['freeNetUsed'] ?? 0;
            $netLimit     = $accountResources['NetLimit'] ?? 0; // Bandwidth from staked TRX
            $netUsed      = $accountResources['NetUsed'] ?? 0;

            // Calculate available bandwidth
            $availableFreeNet        = max(0, $freeNetLimit - $freeNetUsed);
            $availableStakedNet      = max(0, $netLimit - $netUsed);
            $totalAvailableBandwidth = $availableFreeNet + $availableStakedNet;

            // 4. Calculate required TRX for bandwidth
            $bandwidthNeeded  = $transactionSizeInBytes;
            $bandwidthDeficit = max(0, $bandwidthNeeded - $totalAvailableBandwidth);

            // 5. Convert bandwidth to TRX fee (1 TRX = 1000000 SUN)
            // Network burns 100 SUN for every byte of bandwidth
            $trxFee = ($bandwidthDeficit * 100) / 1000000;

            // 6. Add minimum activation fee if needed (0.1 TRX)
            $activationFee = 0;
            if (! isset($accountResources['TotalNetLimit'])) {
                $activationFee = 0.1; // Account activation costs 0.1 TRX
            }

            return $trxFee + $activationFee;
        } catch (\Exception $e) {
            dd($e);
            return $trxFee;
        }
    }

    public function broadcastTrxTransaction($transaction, $user_id) {
        $ownerAddress    = $transaction['raw_data']['contract'][0]['parameter']['value']['owner_address'];
        $ownerAddressKey = GeneratedTronWallet::where('address_base58', $ownerAddress)->value('private_key');

        $this->tron->setAddress($ownerAddress);
        $this->tron->setPrivateKey($ownerAddressKey);

        $signedTransaction = $this->tron->signTransaction($transaction);
        $rawTransaction    = $this->tron->sendRawTransaction($signedTransaction);

        $tnx_id = $this->createTransactionForTron($transaction, 'sent', $user_id);

        return [
            'status' => 'success',
            'txID'   => $rawTransaction['txid'],
            'tnx_id' => $tnx_id,
        ];
    }

    private function createTransactionForTron($transaction, $type, $user_id) {
        $existingTransaction   = Transaction::where('hash_id', $transaction['txID'])->first();
        $userModel             = new User;
        $userBalances          = new UserBalances;
        $userBalancesService   = new UserBalancesService;
        $transactionController = new TransactionController;

        if (! isset($existingTransaction)) {
            $type             = $type;
            $amount           = $transaction['raw_data']['contract'][0]['parameter']['value']['amount'] / 1000000;
            $marketDataPrices = View::getShared()['marketDataPrices'];
            $tnx_id           = mt_rand(10000000, 99999999);

            $trxBalance       = $userBalances->where('user_id', $user_id)->where('wallet', 'TRX')->value('balance');
            $trxLockedBalance = $userBalances->where('user_id', $user_id)->where('wallet', 'TRX')->value('locked_balance');

            [$totalBalance, $totalLockedBalance] = $userBalancesService->calculateUserTotalBalance($user_id);

            $newTransaction = [
                'tnx_id'                     => $tnx_id,
                'user_id'                    => $user_id,
                'ref_user_id'                => $userModel->where('id', $user_id)->value('ref_user_id'),
                'type'                       => $type,
                'amount_in_asset'            => $amount,
                'amount_in_usd'              => $amount * $marketDataPrices['TRX'],
                'asset'                      => 'TRX',
                'asset_price'                => $marketDataPrices['TRX'],
                'asset_balance_after'        => $trxBalance,
                'asset_locked_balance_after' => $trxLockedBalance,
                'total_balance_after'        => $totalBalance,
                'total_locked_balance_after' => $totalLockedBalance,
                'strategy_pack_id'           => null,
                'status'                     => 'pending',
                'hash_id'                    => $transaction['txID'],
            ];

            $transactionController->createTransaction($newTransaction);

            return $tnx_id;
        }
    }
}

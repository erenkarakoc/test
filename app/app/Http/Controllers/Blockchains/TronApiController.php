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

    /**
     * Send a funds request by creating the transaction and calculating its fee.
     */
    public function sendTrxFundsRequest($userId, $amount, $recipientAddress) {
        $senderAddress = GeneratedTronWallet::where('user_id', $userId)->first()->address_hex;

        $transaction = $this->createTransaction($senderAddress, $recipientAddress, $amount);
        $fee         = $this->calculateTrxTransactionFee($transaction);

        return [
            'fee'         => $fee,
            'transaction' => $transaction,
        ];
    }

    /**
     * Create a transaction using the given sender, recipient, and amount.
     */
    public function createTransaction($senderAddress, $recipientAddress, $amount) {
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

    /**
     * Calculate the transaction fee based on the transaction size and available free bandwidth.
     */
    public function calculateTrxTransactionFee($transaction) {
        $ownerAddress    = $transaction['raw_data']['contract'][0]['parameter']['value']['owner_address'];
        $ownerAddressKey = GeneratedTronWallet::where('address_base58', $ownerAddress)->value('private_key');

        $this->tron->setAddress($ownerAddress);
        $this->tron->setPrivateKey($ownerAddressKey);

        $signedTransaction  = $this->tron->signTransaction($transaction);
        $estimatedBandwidth = strlen($transaction['raw_data_hex']);
        foreach ($signedTransaction['signature'] as $i) {
            $estimatedBandwidth += strlen($i);
        }
        $estimatedBandwidth = intval(($estimatedBandwidth / 2) + 69);

        $response = $this->client->post('https://api.shasta.trongrid.io/wallet/getaccountresource', [
            'json' => [
                'address' => $ownerAddress,
            ],
        ]);
        $accountResources = json_decode($response->getBody(), true);

        $freeNetLimit     = $accountResources['freeNetLimit'] ?? 0;
        $freeNetUsed      = $accountResources['freeNetUsed'] ?? 0;
        $availableFreeNet = $freeNetLimit - $freeNetUsed;

        $trxFee = 0;

        if ($availableFreeNet < $estimatedBandwidth) {
            $trxFee = $estimatedBandwidth * 0.001;
        }

        return $trxFee;
    }

    /**
     * Sign and broadcast the transaction.
     */
    public function broadcastTrxTransaction($transaction, $user_id, $amountWithoutBandwidthFee) {
        $ownerAddress    = $transaction['raw_data']['contract'][0]['parameter']['value']['owner_address'];
        $ownerAddressKey = GeneratedTronWallet::where('address_base58', $ownerAddress)->value('private_key');
        $toAdress        = $transaction['raw_data']['contract'][0]['parameter']['value']['to_address'];

        $this->tron->setAddress($ownerAddress);
        $this->tron->setPrivateKey($ownerAddressKey);

        $transaction = $this->tron->send($toAdress, $amountWithoutBandwidthFee);

        $tnx_id = $this->createTransactionForTron($transaction, 'sent', $user_id);

        return [
            'status' => 'success',
            'txID'   => $transaction['txid'],
            'tnx_id' => $tnx_id,
        ];
    }

    public function createTransactionForTron($transaction, $type, $user_id) {
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

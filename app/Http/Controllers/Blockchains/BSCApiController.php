<?php
namespace App\Http\Controllers\Blockchains;

use App\Http\Controllers\TransactionController;
use App\Models\Blockchains\GeneratedBSCWallet;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserBalances;
use App\Services\Blockchains\BSCService;
use App\Services\UserBalancesService;
use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\View;

class BSCApiController {
    protected $client;
    protected $endpoint;

    public function __construct() {
        $this->endpoint = 'https://bsc-testnet.core.chainstack.com/11d764ea62d85653c4fefa228b9120c8/';
        $this->client   = new Client();
    }

    public function generateBSCWalletForUser($user_id) {
        $bscService      = new BSCService;
        $generatedWallet = $bscService->createWallet();

        $renderer = new GDLibRenderer(130);
        $writer   = new Writer($renderer);
        $qr_code  = base64_encode($writer->writeString($generatedWallet['address']));

        GeneratedBSCWallet::create([
            'user_id'     => $user_id,
            'balance'     => 0,
            'address'     => $generatedWallet['address'],
            'private_key' => $generatedWallet['privateKey'],
            'qr_code'     => $qr_code,
        ]);
    }

    public function getBalance($address) {
        $response = $this->client->post($this->endpoint, [
            'json' => [
                'id'      => 1,
                'jsonrpc' => '2.0',
                'method'  => 'eth_getBalance',
                'params'  => [$address, 'pending'],
            ],
        ]);

        $balance = hexdec(json_decode($response->getBody(), true)['result']) / 1e18;

        return response()->json($balance);
    }

    public function sendFundsRequest($user_id, $amount, $recipient_address) {
        $wallet       = GeneratedBSCWallet::where('user_id', $user_id)->first();
        $ownerAddress = $wallet->address;

        $amountWei = bcmul($amount, '1000000000000000000', 0);

        $transaction = [
            'from'  => $ownerAddress,
            'to'    => $recipient_address,
            'value' => '0x' . dechex($amountWei),
        ];

        $responseEstimate = $this->client->post($this->endpoint, [
            'json' => [
                'id'      => 1,
                'jsonrpc' => '2.0',
                'method'  => 'eth_estimateGas',
                'params'  => [$transaction],
            ],
        ]);
        $estimateBody = json_decode($responseEstimate->getBody(), true);
        $gasEstimate  = isset($estimateBody['result']) ? hexdec($estimateBody['result']) : 0;

        $responseGasPrice = $this->client->post($this->endpoint, [
            'json' => [
                'id'      => 1,
                'jsonrpc' => '2.0',
                'method'  => 'eth_gasPrice',
                'params'  => [],
            ],
        ]);
        $gasPriceBody = json_decode($responseGasPrice->getBody(), true);
        $gasPrice     = isset($gasPriceBody['result']) ? hexdec($gasPriceBody['result']) : 0;

        $feeInWei = $gasEstimate * $gasPrice;
        $fee      = $feeInWei / 1e18;

        $transaction['gas']      = '0x' . dechex($gasEstimate);
        $transaction['gasPrice'] = '0x' . dechex($gasPrice);

        return [
            'fee'         => $fee,
            'transaction' => $transaction,
        ];
    }

    public function broadcastBnbTransaction($transaction, $user_id, $amountWithoutGasFee) {
        // Retrieve the wallet (and private key) for the sender.
        $wallet       = GeneratedBSCWallet::where('user_id', $user_id)->first();
        $ownerAddress = $wallet->address;

        // 1. Get the current nonce for the sender's address.
        $responseNonce = $this->client->post($this->endpoint, [
            'json' => [
                'id'      => 1,
                'jsonrpc' => '2.0',
                'method'  => 'eth_getTransactionCount',
                'params'  => [$ownerAddress, 'pending'],
            ],
        ]);
        $nonceBody = json_decode($responseNonce->getBody(), true);
        // The nonce is returned as a hexadecimal string (e.g. "0x1a")
        $nonceHex = $nonceBody['result'];

        // 2. Set the total amount to the transaction object.
        $amountWei            = bcmul($amountWithoutGasFee, '1000000000000000000', 0);
        $transaction['value'] = '0x' . dechex($amountWei);

        // 3. Add the nonce to the transaction object.
        $transaction['nonce'] = $nonceHex;

        // 4. Set the chainId. For example, BSC Testnet uses chainId 97.
        $transaction['chainId'] = env('APP_ENV') === 'local' ? 97 : 56;

        // 5. Sign the transaction.
        // Using the web3p/ethereum-tx library to sign the transaction with the sender's private key.
        $tx          = new \Web3p\EthereumTx\Transaction($transaction);
        $signedTx    = $tx->sign($wallet->private_key);
        $signedTxHex = '0x' . $signedTx;

        // 6. Broadcast the signed transaction using eth_sendRawTransaction.
        $responseSend = $this->client->post($this->endpoint, [
            'json' => [
                'id'      => 1,
                'jsonrpc' => '2.0',
                'method'  => 'eth_sendRawTransaction',
                'params'  => [$signedTxHex],
            ],
        ]);
        $sendBody = json_decode($responseSend->getBody(), true);

        $transactionHash = $sendBody['result'];
        $amount          = $amountWithoutGasFee;
        $tnx_id          = $this->createTransactionForBsc('sent', $user_id, $amount, $transactionHash);

        dd($tnx_id);

        return $tnx_id;
    }

    private function createTransactionForBsc($type, $user_id, $amount, $transactionHash) {
        $existingTransaction   = Transaction::where('hash_id', $transactionHash)->first();
        $userModel             = new User();
        $userBalances          = new UserBalances();
        $userBalancesService   = new UserBalancesService;
        $transactionController = new TransactionController;

        if (! isset($existingTransaction)) {
            $type             = $type;
            $amount           = $amount;
            $marketDataPrices = View::getShared()['marketDataPrices'];
            $tnx_id           = mt_rand(10000000, 99999999);

            $bnbBalance       = $userBalances->where('user_id', $user_id)->where('wallet', 'BNB')->value('balance');
            $bnbLockedBalance = $userBalances->where('user_id', $user_id)->where('wallet', 'BNB')->value('locked_balance');

            [$totalBalance, $totalLockedBalance] = $userBalancesService->calculateUserTotalBalance($user_id);

            $newTransaction = [
                'tnx_id'                     => $tnx_id,
                'user_id'                    => $user_id,
                'ref_user_id'                => $userModel->where('id', $user_id)->value('ref_user_id'),
                'type'                       => $type,
                'amount_in_asset'            => $amount,
                'amount_in_usd'              => $amount * $marketDataPrices['BNB'],
                'asset'                      => 'BNB',
                'asset_price'                => $marketDataPrices['BNB'],
                'asset_balance_after'        => $bnbBalance,
                'asset_locked_balance_after' => $bnbLockedBalance,
                'total_balance_after'        => $totalBalance,
                'total_locked_balance_after' => $totalLockedBalance,
                'strategy_pack_id'           => null,
                'status'                     => 'pending',
                'hash_id'                    => $transactionHash,
            ];

            $transactionController->createTransaction($newTransaction);

            return $tnx_id;
        }
    }
}

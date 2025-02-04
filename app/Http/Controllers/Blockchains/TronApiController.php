<?php
namespace App\Http\Controllers\Blockchains;

use App\Http\Controllers\Controller;
use App\Models\Blockchains\GeneratedTronWallet;
use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;

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

    public function calculateEstimatedTrxFee($senderAddress, $recipientAddress, $amount) {
        $transaction = $this->createTransaction($senderAddress, $recipientAddress, $amount);
        $fee         = $this->calculateTrxTransactionFee($senderAddress);

        return ['fee' => $fee, 'transaction' => $transaction];
    }

    private function createTransaction($senderAddress, $recipientAddress, $amount) {
        $response = $this->client->post('https://api.shasta.trongrid.io/wallet/createtransaction', [
            'json'    => [
                'owner_address' => $this->tron->toHex($senderAddress),
                'to_address'    => $this->tron->toHex($recipientAddress),
                'amount'        => $amount * 1000000,
            ],
            'headers' => [
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    private function calculateTrxTransactionFee($senderAddress) {
        $response = $this->client->post('https://api.shasta.trongrid.io/wallet/getaccountresource', [
            'json' => [
                'address' => $this->tron->toHex($senderAddress),
            ],
        ]);
        $data = json_decode($response->getBody(), true);

        $trxFee             = 0;
        $bandwidthRequired  = 250;
        $availableBandwidth = $data['freeNetLimit'] ?? 0;

        if ($availableBandwidth < $bandwidthRequired) {
            $trxFee = ($bandwidthRequired - $availableBandwidth) * 0.000001;
        }

        return $trxFee;
    }

    public function broadcastTrxTransaction($transaction) {
        $response = $this->client->post('https://api.shasta.trongrid.io/wallet/broadcasttransaction', [
            'json'    => $transaction,
            'headers' => [
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        $transaction = json_decode($response->getBody(), true);

        return [
            'code'    => $transaction['code'],
            'message' => $transaction['message'],
            'txID'    => $transaction['txid'],
        ];
    }
}

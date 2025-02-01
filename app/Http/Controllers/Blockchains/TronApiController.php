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
        $fee         = $this->calculateTransactionFee($transaction);

        return $fee;
    }

    private function getBandwidthPrice() {
        $response       = $this->client->get('https://api.shasta.trongrid.io/wallet/getchainparameters');
        $data           = json_decode($response->getBody(), true);
        $bandwidthPrice = $data['chainParameter'][3]['value'] / 1000000;
        return $bandwidthPrice;
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

    private function calculateTransactionFee($transaction) {
        $response = $this->client->post('https://api.shasta.trongrid.io/wallet/estimateenergy', [
            'json'    => $transaction,
            'headers' => [
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        $estimateData   = json_decode($response->getBody(), true);
        $energyRequired = $estimateData['energy_required'];
        $bandwidthPrice = $this->getBandwidthPrice();

        return $energyRequired * $bandwidthPrice;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Blockchains\GeneratedBitcoinWallet;
use App\Services\BitcoinRPC;
use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;
use GuzzleHttp\Client;

class TestController extends Controller
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function test()
    {
        $bitcoin = new BitcoinRPC();
        $generatedWallet = $bitcoin->call('getnewaddress');

        $renderer = new GDLibRenderer(130);
        $writer = new Writer($renderer);
        $qr_code = base64_encode($writer->writeString($generatedWallet['result']));

        GeneratedBitcoinWallet::create([
            'user_id' => 1,
            'balance' => 0.00,
            'address' => $generatedWallet['result'],
            'qr_code' => $qr_code,
        ]);
    }
}

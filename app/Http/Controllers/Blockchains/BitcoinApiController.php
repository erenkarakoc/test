<?php

namespace App\Http\Controllers\Blockchains;

use App\Http\Controllers\Controller;
use App\Models\Blockchains\GeneratedBitcoinWallet;
use App\Services\BitcoinRPC;
use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;
use GuzzleHttp\Client;

class BitcoinApiController extends Controller
{
  protected $client;
  protected $apiKey;

  public function __construct()
  {
    $this->client = new Client();
  }

  public function generateBitcoinWalletForUser($user_id)
  {
    $bitcoin = new BitcoinRPC();
    $generatedWallet = $bitcoin->call('getnewaddress');

    $renderer = new GDLibRenderer(130);
    $writer = new Writer($renderer);
    $qr_code = base64_encode($writer->writeString($generatedWallet['result']));

    GeneratedBitcoinWallet::create([
      'user_id' => $user_id,
      'balance' => 0,
      'address' => $generatedWallet['result'],
      'qr_code' => $qr_code,
    ]);
  }
}

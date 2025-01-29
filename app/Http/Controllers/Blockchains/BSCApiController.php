<?php

namespace App\Http\Controllers\Blockchains;

use App\Models\Blockchains\GeneratedBSCWallet;
use App\Services\Blockchains\BSCService;
use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;
use GuzzleHttp\Client;

class BSCApiController
{
  protected $endpoint;

  public function __construct()
  {
    $this->endpoint = 'https://bsc-testnet.core.chainstack.com/11d764ea62d85653c4fefa228b9120c8/';
  }

  public function generateBSCWalletForUser($user_id)
  {
    $bscService = new BSCService;
    $generatedWallet = $bscService->createWallet();

    $renderer = new GDLibRenderer(130);
    $writer = new Writer($renderer);
    $qr_code = base64_encode($writer->writeString($generatedWallet['address']));

    GeneratedBSCWallet::create([
      'user_id' => $user_id,
      'balance' => 0,
      'address' => $generatedWallet['address'],
      'private_key' => $generatedWallet['privateKey'],
      'qr_code' => $qr_code,
    ]);
  }

  public function getBalance($address)
  {
    $client = new Client();

    $response = $client->post($this->endpoint, [
      'json' => [
        'id' => 1,
        'jsonrpc' => '2.0',
        'method' => 'eth_getBalance',
        'params' => [$address, 'pending'],
      ],
    ]);

    $balance = hexdec(json_decode($response->getBody(), true)['result']) / 1e18;

    return response()->json($balance);
  }
}

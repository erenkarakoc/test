<?php

namespace App\Http\Controllers\Blockchains;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TransactionController;
use App\Models\Blockchains\GeneratedTronWallet;
use App\Models\UserBalances;
use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;
use Illuminate\Http\Request;

class TronApiController extends Controller
{
  protected $fullNode;

  protected $solidityNode;

  protected $eventServer;


  public function __construct()
  {
    parent::__construct();
    $this->fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
    $this->solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
  }


  public function generateTronWalletForUser($user_id)
  {
    $tron = new \IEXBase\TronAPI\Tron($this->fullNode, $this->solidityNode, $this->eventServer);
    $generatedWallet = $tron->createAccount();

    $renderer = new GDLibRenderer(130);
    $writer = new Writer($renderer);
    $qr_code = base64_encode($writer->writeString($generatedWallet->getAddress(true)));

    $wallet = [
      'user_id' => $user_id,
      'trx_balance' => 0,
      'usdt_balance' => 0,
      'private_key' => $generatedWallet->getPrivateKey(),
      'public_key' => $generatedWallet->getPublicKey(),
      'address_hex' => $generatedWallet->getAddress(true),
      'address_base58' => $generatedWallet->getAddress(),
      'qr_code' => $qr_code,
    ];

    GeneratedTronWallet::create($wallet);
  }
}

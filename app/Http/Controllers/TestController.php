<?php

namespace App\Http\Controllers;

use App\Models\Blockchains\GeneratedBitcoinWallet;
use App\Services\BitcoinRPC;
use App\Services\BNBService;
use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;
use GuzzleHttp\Client;

class TestController extends Controller
{
  protected $address;

  protected $priv;

  public function __construct()
  {
  }

  public function test()
  {

  }
}

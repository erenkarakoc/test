<?php

namespace App\Http\Controllers;

use App\Models\GeneratedTronWallet;
use App\Models\UserBalances;
use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use \IEXBase\TronAPI\Support\Base58;

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

    public function createTransactionForTron(Request $request)
    {
        $request->validate([
            'asset' => 'required|string',
            'asset_price' => 'required|numeric',
            'amount_in_asset' => 'required|numeric',
            'amount_in_usd' => 'required|numeric',
        ]);

        [$totalBalance, $totalLockedBalance] = $this->calculateUserTotalBalance();

        $transaction = [
            'type' => 'received',
            'amount_in_asset' => $request->amount_in_asset,
            'amount_in_usd' => $request->amount_in_usd,
            'asset' => $request->asset,
            'asset_price' => $request->asset_price,
            'asset_balance_after' => UserBalances::where('wallet', $request->asset)->value('balance'),
            'asset_locked_balance_after' => UserBalances::where('wallet', $request->asset)->value('locked_balance'),
            'total_balance_after' => $totalBalance,
            'total_locked_balance_after' => $totalLockedBalance,
            'status' => 'pending',
        ];

        $transactionController = new TransactionController;
        $newTransaction = $transactionController->createTransaction($transaction);

        return response()->json([
            'success' => true,
            'data' => $newTransaction,
        ]);
    }

    public function generateTronWalletForUser($user_id) {
      $response = $this->client->request('GET', 'https://api.tatum.io/v3/tron/wallet', [
        'headers' => [
          'accept' => 'application/json',
          'x-api-key' => 't-66a730ccccfd17001c479705-2f597d14ad7543f289a03418',
        ]
      ]);

      $walletData = $response->json();

      dd($walletData);

      $generatedWallet = [
          'user_id' => $user_id,
          'trx_balance' => 0,
          'usdt_balance' => 0,
          'private_key' => $walletData['data']['privateKey'],
          'public_key' => $walletData['data']['publicKey'],
          'address_hex' => $walletData['data']['address'],
          'address_base58' => '',
          'qr_code' => $qr_code,
          'asset' => 'TRX',
      ];

      // Create a new wallet record in your database
      GeneratedTronWallet::create($generatedWallet);
    }

    public function oldGenerateTronWalletForUser($user_id)
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
          'asset' => 'TRX',
      ];

      GeneratedTronWallet::create($wallet);
    }

    public function checkTronWalletBalance(Request $request)
    {
        $request->validate([
            'address_hex' => 'required|string',
        ]);

        $generatedWallet = GeneratedTronWallet::where('address_hex', $request->address_hex)->first();

        return response()->json([
            'success' => true,
            'trx_balance_received' => $generatedWallet->trx_balance,
            'usdt_balance_received' => $generatedWallet->usdt_balance,
        ]);
    }

    public function getGeneratedTronWalletByTransaction(Request $request)
    {
      $request->validate([
        'tnx_id' => "required|string"
      ]);

      $generatedWallet = GeneratedTronWallet::where('tnx_id', $request->tnx_id)->first();

      return response()->json([
        'qr_code' => $generatedWallet->qr_code,
        'address_hex' => $generatedWallet->address_hex
      ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\GeneratedTronWallet;
use App\Models\UserBalances;
use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TronApiController extends Controller
{
    protected $fullNode;

    protected $solidityNode;

    protected $eventServer;

    public function __construct()
    {
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

        $transaction = [
            'type' => 'deposit',
            'amount_in_asset' => $request->amount_in_asset,
            'amount_in_usd' => $request->amount_in_usd,
            'asset' => $request->asset,
            'asset_price' => $request->asset_price,
            'asset_balance_after' => UserBalances::where('wallet', $request->asset)->value('balance'),
            'asset_locked_balance_after' => UserBalances::where('wallet', $request->asset)->value('locked_balance'),
            'total_balance_after' => UserBalances::where('wallet', 'Total')->value('balance'),
            'total_locked_balance_after' => UserBalances::where('wallet', 'Total')->value('locked_balance'),
            'status' => 'pending',
        ];

        $transactionController = new TransactionController;
        $newTransaction = $transactionController->createTransaction($transaction);

        return response()->json([
            'success' => true,
            'data' => $newTransaction,
        ]);
    }

    public function generateTronWallet(Request $request)
    {
        $request->validate([
            'tnx_id' => 'required|numeric',
            'asset_price' => 'required|numeric',
        ]);

        $tron = new \IEXBase\TronAPI\Tron($this->fullNode, $this->solidityNode, $this->eventServer);
        $generatedWallet = $tron->createAccount();

        $wallet = [
            'user_id' => Auth::user()->id,
            'tnx_id' => $request->tnx_id,
            'trx_balance' => 0,
            'usdt_balance' => 0,
            'amount_in_usd' => 0,
            'asset_price' => $request->asset_price,
            'private_key' => $generatedWallet->getPrivateKey(),
            'public_key' => $generatedWallet->getPublicKey(),
            'address_hex' => $generatedWallet->getAddress(true),
            'address_base58' => $generatedWallet->getAddress(),
            'status' => 'generated',
        ];

        $renderer = new GDLibRenderer(130);
        $writer = new Writer($renderer);
        $qr_code = base64_encode($writer->writeString($generatedWallet->getAddress(true)));

        GeneratedTronWallet::create($wallet);

        return response()->json([
            'success' => true,
            'tnx_id' => $request->tnx_id,
            'wallet_address' => $generatedWallet->getAddress(true),
            'qr_code' => $qr_code,
        ]);
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
}

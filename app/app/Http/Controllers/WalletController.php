<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Blockchains\BscApiController;
use App\Http\Controllers\Blockchains\TronApiController;
use App\Models\Asset;
use App\Models\User;
use App\Models\UserBalances;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class WalletController extends Controller {
    protected $tronApiController;

    protected $bscApiController;

    public function __construct() {
        $this->tronApiController = new TronApiController;
        $this->bscApiController  = new BscApiController;
    }

    /**
     * Store a new wallet for the user.
     */
    public function store(Request $request) {
        $request->validate([
            'title'          => 'required|string',
            'symbol'         => 'required|string',
            'label'          => 'nullable|string',
            'wallet_address' => 'required|string',
        ]);

        $user = Auth::user();
        $user = User::find(Auth::id());

        $newWallet = [
            'id'             => Str::uuid(),
            'title'          => $request->title,
            'symbol'         => $request->symbol,
            'wallet_address' => $request->wallet_address,
            'active'         => true,
        ];

        if ($request->has('label')) {
            $newWallet['label'] = $request->label;
        }

        $walletArray = is_array($user->wallet) ? $user->wallet : json_decode($user->wallet, true) ?? [];

        $walletArray[] = $newWallet;

        $user->wallet = $walletArray;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Wallet added successfully!',
            'data'    => $newWallet,
        ]);
    }

    /**
     * Update the wallet (e.g., add funds or modify balances).
     */
    public function update(Request $request) {
        $request->validate([
            'id'             => 'required|string',
            'label'          => 'nullable|string',
            'wallet_address' => 'required|string',
            'active'         => 'required|string',
        ]);

        $user = Auth::user();
        $user = User::find(Auth::id());

        $walletArray = is_array($user->wallet) ? $user->wallet : json_decode($user->wallet, true) ?? [];
        $walletIndex = array_search($request->id, array_column($walletArray, 'id'));

        $walletArray[$walletIndex]['wallet_address'] = $request->wallet_address;
        $walletArray[$walletIndex]['active']         = $request->active === 'true' ? true : false;
        if ($request->has('label')) {
            $walletArray[$walletIndex]['label'] = $request->label;
        }

        $user->wallet = $walletArray;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Wallet updated successfully!',
            'data'    => $walletArray[$walletIndex],
        ]);
    }

    /**
     * Destroy a wallet by its ID.
     */
    public function destroy(Request $request) {
        $request->validate([
            'id' => 'required|string',
        ]);

        $user = Auth::user();
        $user = User::find(Auth::id());

        // Decode existing wallets or initialize an empty array
        $walletArray = is_array($user->wallet) ? $user->wallet : json_decode($user->wallet, true) ?? [];

        // Find the wallet by ID
        $walletIndex = array_search($request->id, array_column($walletArray, 'id'));

        if ($walletIndex === false) {
            return response()->json([
                'success' => false,
                'message' => 'Wallet not found.',
            ], 404);
        }

        // Remove the wallet
        unset($walletArray[$walletIndex]);

        // Reindex the array to prevent gaps
        $walletArray = array_values($walletArray);

        $user->wallet = $walletArray;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Wallet removed successfully!',
        ]);
    }

    /**
     * Send funds request to the selected wallet.
     */
    public function sendFundsRequest(Request $request) {
        $request->validate([
            'wallet' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $user            = Auth::user();
        $requestedWallet = collect($user->wallet)->where('symbol', $request->wallet)->first();
        $userBalance     = UserBalances::where('user_id', $user->id)->where('wallet', $request->wallet)->first();

        // Verify the requested asset exists
        $assetExists = Asset::where('symbol', $request->wallet)->exists();
        if (! $assetExists) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid asset symbol',
            ]);
        }

        // Check if user has sufficient balance
        if (! $userBalance || $userBalance->balance < $request->amount) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient balance',
            ]);
        }

        $sendFundsRequest = [];

        if ($request->wallet === 'TRX') {
            $sendFundsRequest = $this->tronApiController->sendTrxFundsRequest($user->id, $request->amount, $requestedWallet['wallet_address']);
        }
        if ($request->wallet === 'BNB') {
            $sendFundsRequest = $this->bscApiController->sendFundsRequest($user->id, $request->amount, $requestedWallet['wallet_address']);
        }

        $marketDataPrices = View::getShared()['marketDataPrices'];
        $fee              = $sendFundsRequest['fee'];

        return response()->json([
            'success'         => true,
            'fee'             => $fee,
            'transaction'     => $sendFundsRequest['transaction'],
            'asset'           => $request->wallet,
            'amount_in_asset' => $request->amount,
            'amount_in_usd'   => $request->amount * $marketDataPrices[$request->wallet],
            'total'           => $request->amount - $fee,
        ]);
    }

    /**
     * Complete the send funds request.
     */
    public function completeSendFunds(Request $request) {
        $request->validate([
            'asset'       => 'string|required',
            'transaction' => 'array|required',
            'amount'      => 'numeric|required',
        ]);

        if ($request->asset === 'TRX') {
            $broadcast = $this->tronApiController->broadcastTrxTransaction($request->transaction, Auth::user()->id, $request->amount);

            return response()->json($broadcast);
        }

        if ($request->asset === 'BNB') {
            $broadcast = $this->bscApiController->broadcastBnbTransaction($request->transaction, Auth::user()->id, $request->amount);

            return response()->json($broadcast);
        }
    }
}

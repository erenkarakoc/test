<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WalletController extends Controller
{
    /**
     * Store a new wallet for the user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'symbol' => 'required|string',
            'label' => 'nullable|string',
            'wallet_address' => 'required|string',
        ]);

        $user = Auth::user();

        $newWallet = [
            'id' => Str::uuid(),
            'title' => $request->title,
            'symbol' => $request->symbol,
            'wallet_address' => $request->wallet_address,
            'active' => true,
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
            'data' => $newWallet,
        ]);
    }

    /**
     * Update the wallet (e.g., add funds or modify balances).
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|string',
            'label' => 'nullable|string',
            'wallet_address' => 'required|string',
            'active' => 'required|string',
        ]);

        $user = Auth::user();

        $walletArray = is_array($user->wallet) ? $user->wallet : json_decode($user->wallet, true) ?? [];
        $walletIndex = array_search($request->id, array_column($walletArray, 'id'));

        $walletArray[$walletIndex]['wallet_address'] = $request->wallet_address;
        $walletArray[$walletIndex]['active'] = $request->active === 'true' ? true : false;
        if ($request->has('label')) {
            $walletArray[$walletIndex]['label'] = $request->label;
        }

        $user->wallet = $walletArray;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Wallet updated successfully!',
            'data' => $walletArray[$walletIndex],
        ]);
    }

    /**
     * Destroy a wallet by its ID.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|string',
        ]);

        $user = Auth::user();

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
}

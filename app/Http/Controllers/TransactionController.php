<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Create a new transaction.
     *
     * @param  array  $newTransaction
     * @return \Illuminate\Http\JsonResponse
     */
    public function createTransaction($newTransaction)
    {
        $transaction = Transaction::create([
            'tnx_id' => mt_rand(10000000, 99999999),
            'user_id' => Auth::user()->id,
            'ref_user_id' => Auth::user()->ref_id,
            'type' => $newTransaction['type'],
            'amount_in_asset' => $newTransaction['amount_in_asset'],
            'amount_in_usd' => $newTransaction['amount_in_usd'],
            'asset' => $newTransaction['asset'],
            'asset_price' => $newTransaction['asset_price'],
            'asset_balance_after' => $newTransaction['asset_balance_after'],
            'asset_locked_balance_after' => $newTransaction['asset_locked_balance_after'],
            'total_balance_after' => $newTransaction['total_balance_after'],
            'total_locked_balance_after' => $newTransaction['total_locked_balance_after'],
            'strategy_pack_id' => $newTransaction['strategy_pack_id'] ?? null,
            'status' => $newTransaction['status'],
            'hash_id' => $newTransaction['hash_id'] ?? null,
        ]);

        return $transaction;
    }

    /**
     * Cancel the transaction with the provided Transaction ID.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelTransaction(Request $request)
    {
        $request->validate([
            'tnx_id' => 'required|string',
        ]);

        $transactionToCancel = Transaction::where('tnx_id', $request->tnx_id)->first();
        $transactionToCancel->status = 'cancelled';
        $transactionToCancel->save();

        return response()->json([
            'cancelledTransaction' => $transactionToCancel,
        ]);
    }

    public function getTransactionById(Request $request)
    {
        $request->validate([
          'tnx_id' => 'required|string'
        ]);

        $transaction = Transaction::where('tnx_id', $request->tnx_id)->first();

        return response()->json($transaction);
    }
}

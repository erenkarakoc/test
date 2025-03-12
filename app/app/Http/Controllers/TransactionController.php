<?php
namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller {

    public function createTransaction($newTransaction) {
        $transaction = Transaction::create([
            'tnx_id'                     => $newTransaction['tnx_id'],
            'user_id'                    => $newTransaction['user_id'],
            'ref_user_id'                => $newTransaction['ref_user_id'] ?? null,
            'type'                       => $newTransaction['type'],
            'swap_to_asset'              => $newTransaction['swap_to_asset'] ?? null,
            'amount_in_asset'            => $newTransaction['amount_in_asset'],
            'amount_in_usd'              => $newTransaction['amount_in_usd'],
            'asset'                      => $newTransaction['asset'],
            'asset_price'                => $newTransaction['asset_price'],
            'asset_balance_after'        => $newTransaction['asset_balance_after'],
            'asset_locked_balance_after' => $newTransaction['asset_locked_balance_after'],
            'total_balance_after'        => $newTransaction['total_balance_after'],
            'total_locked_balance_after' => $newTransaction['total_locked_balance_after'],
            'locked_pack_id'             => $newTransaction['locked_pack_id'] ?? null,
            'status'                     => $newTransaction['status'],
            'hash_id'                    => $newTransaction['hash_id'] ?? null,
            'trade_info'                 => $newTransaction['trade_info'] ?? json_encode([]),
        ]);

        return $transaction;
    }

    public function cancelTransaction(Request $request) {
        $request->validate([
            'tnx_id' => 'required|string',
        ]);

        $transactionToCancel         = Transaction::where('tnx_id', $request->tnx_id)->first();
        $transactionToCancel->status = 'cancelled';
        $transactionToCancel->save();

        return response()->json([
            'cancelledTransaction' => $transactionToCancel,
        ]);
    }

    public function getTransactionById(Request $request) {
        $request->validate([
            'tnx_id' => 'required|string',
        ]);

        $transaction = Transaction::where('tnx_id', $request->tnx_id)->first();

        return response()->json($transaction);
    }

    public function setTransactionStatus($tnx_id, $newStatus) {
        $transaction         = Transaction::where('tnx_id', $tnx_id)->first();
        $transaction->status = $newStatus;
        $transaction->save();
    }
}

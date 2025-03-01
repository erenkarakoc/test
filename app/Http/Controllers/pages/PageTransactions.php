<?php
namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class PageTransactions extends Controller {
    public function index() {
        $transactions            = Transaction::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        $transactionsExceptTrade = Transaction::where('user_id', Auth::user()->id)->where('type', '!=', 'trade')->orderBy('created_at', 'desc')->paginate(10);

        $totalReceived = $transactions->where('type', 'received')->where('status', 'completed')->sum('amount_in_usd');
        $totalSent     = $transactions->where('type', 'sent')->where('status', 'completed')->sum('amount_in_usd');
        $totalTrade    = $transactions->where('type', 'trade')->where('status', 'completed')->sum('amount_in_usd');
        $totalBonus    = $transactions->where('type', 'bonus')->where('status', 'completed')->sum('amount_in_usd');

        $receivedTransactions = Transaction::where('user_id', Auth::user()->id)->where('type', 'received')->orderBy('created_at', 'desc')->paginate(10);
        $sentTransactions     = Transaction::where('user_id', Auth::user()->id)->where('type', 'sent')->orderBy('created_at', 'desc')->paginate(10);
        $swapTransactions     = Transaction::where('user_id', Auth::user()->id)->where('type', 'swap')->orderBy('created_at', 'desc')->paginate(10);
        $lockedTransactions   = Transaction::where('user_id', Auth::user()->id)->where('type', 'locked')->orderBy('created_at', 'desc')->paginate(10);
        $bonusTransactions    = Transaction::where('user_id', Auth::user()->id)->where('type', 'bonus')->orderBy('created_at', 'desc')->paginate(10);

        return view('content.pages.page-transactions', compact('totalReceived', 'totalSent', 'totalTrade', 'totalBonus', 'transactions', 'receivedTransactions', 'sentTransactions', 'swapTransactions', 'lockedTransactions', 'bonusTransactions', 'transactionsExceptTrade'));
    }
}

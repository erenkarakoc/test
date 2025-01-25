<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class PageTransactions extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);

        $totalReceived = $transactions->where('type', 'received')->where('status', 'completed')->sum('amount_in_usd');
        $totalSent = $transactions->where('type', 'sent')->where('status', 'completed')->sum('amount_in_usd');
        $totalEarned = $transactions->where('type', 'earned')->where('status', 'completed')->sum('amount_in_usd');
        $totalBonus = $transactions->where('type', 'bonus')->where('status', 'completed')->sum('amount_in_usd');

        $receivedTransactions = Transaction::where('user_id', Auth::user()->id)->where('type', 'received')->orderBy('created_at', 'desc')->paginate(10);
        $sentTransactions = Transaction::where('user_id', Auth::user()->id)->where('type', 'sent')->orderBy('created_at', 'desc')->paginate(10);
        $lockedTransactions = Transaction::where('user_id', Auth::user()->id)->where('type', 'locked')->orderBy('created_at', 'desc')->paginate(10);
        $earnedTransactions = Transaction::where('user_id', Auth::user()->id)->where('type', 'earned')->orderBy('created_at', 'desc')->paginate(10);
        $bonusTransactions  = Transaction::where('user_id', Auth::user()->id)->where('type', 'bonus')->orderBy('created_at', 'desc')->paginate(10);

        return view('content.pages.page-transactions', compact('totalReceived', 'totalSent', 'totalEarned', 'totalBonus', 'transactions', 'receivedTransactions', 'sentTransactions', 'lockedTransactions', 'earnedTransactions', 'bonusTransactions'));
    }
}

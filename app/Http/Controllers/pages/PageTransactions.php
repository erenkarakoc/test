<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class PageTransactions extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::user()->id)->get();
        $totalReceived = $transactions->where('type', 'deposit')->where('status', 'completed')->sum('amount_in_usd');
        $totalSent = $transactions->where('type', 'withdraw')->where('status', 'completed')->sum('amount_in_usd');
        $totalEarned = $transactions->where('type', 'earned')->where('status', 'completed')->sum('amount_in_usd');
        $totalBonus = $transactions->where('type', 'referral_bonus')->where('status', 'completed')->sum('amount_in_usd');

        return view('content.pages.page-transactions', compact('transactions', 'totalReceived', 'totalSent', 'totalEarned', 'totalBonus'));
    }
}

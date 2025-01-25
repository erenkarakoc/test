<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Algorithm;
use App\Models\StrategyPacks;
use App\Models\Transaction;
use App\Models\UserBalances;
use Illuminate\Support\Facades\Auth;

class PageDashboard extends Controller
{
    public function index()
    {
        $userBalances = UserBalances::all();
        $transactions = Transaction::where('user_id', Auth::user()->id)->get();
        $transactionsExceptEarned = Transaction::where('type', '!=', 'earned')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->limit(5)->get();
        $transactionsEarned = Transaction::where('type', 'earned')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->limit(5)->get();
        $totalReceived = $transactions->where('type', 'received')->where('status', 'completed')->sum('amount_in_usd');
        $totalSent = $transactions->where('type', 'sent')->where('status', 'completed')->sum('amount_in_usd');
        $totalEarned = $transactions->where('type', 'earned')->where('status', 'completed')->sum('amount_in_usd');
        $totalBonus = $transactions->where('type', 'bonus')->where('status', 'completed')->sum('amount_in_usd');
        $strategyPacks = StrategyPacks::all();
        $algorithms = Algorithm::all();

        return view('content.pages.page-dashboard', compact('userBalances', 'transactionsExceptEarned', 'transactionsEarned', 'totalReceived', 'totalSent', 'totalEarned', 'totalBonus', 'strategyPacks', 'algorithms'));
    }
}

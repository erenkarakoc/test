<?php
namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Algorithm;
use App\Models\StrategyPacks;
use App\Models\Transaction;
use App\Models\UserBalances;
use Illuminate\Support\Facades\Auth;

class PageDashboard extends Controller {
    public function index() {
        $userBalances            = UserBalances::all();
        $transactions            = Transaction::where('user_id', Auth::user()->id)->get();
        $transactionsExceptTrade = Transaction::where('type', '!=', 'trade')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->limit(5)->get();
        $transactionsTrade       = Transaction::where('type', 'trade')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->limit(5)->get();
        $totalReceived           = $transactions->where('type', 'received')->where('status', 'completed')->sum('amount_in_usd');
        $totalSent               = $transactions->where('type', 'sent')->where('status', 'completed')->sum('amount_in_usd');
        $totalTrade              = $transactions->where('type', 'trade')->where('status', 'completed')->sum('amount_in_usd');
        $totalBonus              = $transactions->where('type', 'bonus')->where('status', 'completed')->sum('amount_in_usd');
        $strategyPacks           = StrategyPacks::all();
        $algorithms              = Algorithm::all();

        return view('content.pages.page-dashboard', compact('userBalances', 'transactionsExceptTrade', 'transactionsTrade', 'totalReceived', 'totalSent', 'totalTrade', 'totalBonus', 'strategyPacks', 'algorithms'));
    }
}

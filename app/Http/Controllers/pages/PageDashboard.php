<?php
namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Algorithm;
use App\Models\StrategyPacks;
use App\Models\Transaction;
use App\Models\UserBalances;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PageDashboard extends Controller {
    protected $marketDataPrices;

    public function __construct() {
        parent::__construct();
        $this->marketDataPrices = View::getShared()['marketDataPrices'];
    }

    public function index() {
        $userBalances = UserBalances::all();

        $transactions            = Transaction::where('user_id', Auth::user()->id)->get();
        $transactionsExceptTrade = Transaction::where('type', '!=', 'trade')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->limit(5)->get();
        $transactionsTrade       = Transaction::where('type', 'trade')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->limit(5)->get();

        $strategyPacks = StrategyPacks::all();
        $algorithms    = Algorithm::all();

        $totalReceived = $transactions->where('type', 'received')->where('status', 'completed')
            ->sum(function ($transaction) {
                return $transaction->amount_in_asset * $this->marketDataPrices[$transaction->asset];
            });
        $totalSent = $transactions->where('type', 'sent')->where('status', 'completed')
            ->sum(function ($transaction) {
                return $transaction->amount_in_asset * $this->marketDataPrices[$transaction->asset];
            });
        $totalTrade = $transactions->where('type', 'trade')->where('status', 'completed')
            ->sum(function ($transaction) {
                return $transaction->amount_in_asset * $this->marketDataPrices[$transaction->asset];
            });
        $totalBonus = $transactions->where('type', 'bonus')->where('status', 'completed')
            ->sum(function ($transaction) {
                return $transaction->amount_in_asset * $this->marketDataPrices[$transaction->asset];
            });

        return view('content.pages.page-dashboard', compact('userBalances', 'transactions', 'transactionsExceptTrade', 'transactionsTrade', 'strategyPacks', 'algorithms', 'totalReceived', 'totalSent', 'totalTrade', 'totalBonus'));
    }
}

<?php
namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\LockedPack;
use App\Models\StrategyPacks;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PageBundledPacks extends Controller {
    public function index() {
        // Store the current time in session when page is loaded
        $pageLoadTime = now();
        Session::put('trades_page_loaded_at', $pageLoadTime);

        $strategyPacks = StrategyPacks::all();
        $bundledPacks  = LockedPack::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $allTrades = Transaction::where('user_id', Auth::user()->id)
            ->where('type', 'trade')
            ->get();

        $recentTrades = $allTrades->sortByDesc('created_at')->take(10);

        // Store the IDs of trades already sent to frontend
        $initialTradeIds = $recentTrades->pluck('id')->toArray();
        Session::put('initial_trade_ids', $initialTradeIds);

        $pnl = [];
        foreach ($allTrades as $trade) {
            $packAmount = $bundledPacks->where('id', $trade->locked_pack_id)->value('amount');

            if (! isset($pnl[$trade->locked_pack_id])) {
                $pnl[$trade->locked_pack_id] = [
                    'amount'     => 0,
                    'percentage' => 0,
                ];
            }

            $pnl[$trade->locked_pack_id]['amount'] += $trade->amount_in_usd;
            $pnl[$trade->locked_pack_id]['percentage'] += ($trade->amount_in_usd / $packAmount) * 100;
        }

        return view('content.pages.algo.page-bundled-packs', compact(
            'bundledPacks',
            'strategyPacks',
            'pnl',
            'recentTrades'
        ));
    }

    public function getNewTrades() {
        $user_id         = Auth::user()->id;
        $pageLoadTime    = Session::get('trades_page_loaded_at', now());
        $initialTradeIds = Session::get('initial_trade_ids', []);

        // Get both new trades and initial trades
        $trades = Transaction::where('type', 'trade')
            ->where('user_id', $user_id)
            ->where(function ($query) use ($pageLoadTime, $initialTradeIds) {
                $query->where('created_at', '>', $pageLoadTime)
                    ->orWhereIn('id', $initialTradeIds);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($trades);
    }
}
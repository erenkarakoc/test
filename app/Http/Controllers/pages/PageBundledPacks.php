<?php
namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\LockedPack;
use App\Models\StrategyPacks;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class PageBundledPacks extends Controller {
    public function index() {
        $transactions  = Transaction::where('user_id', Auth::user()->id)->where('type', 'trade')->orderBy('created_at', 'desc')->get();
        $strategyPacks = StrategyPacks::all();
        $bundledPacks  = LockedPack::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $trades        = Transaction::where('user_id', Auth::user()->id)->where('type', 'trade')->get();

        $pnl = [];
        foreach ($trades as $trade) {
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

        return view('content.pages.algo.page-bundled-packs', compact('bundledPacks', 'strategyPacks', 'pnl', 'transactions'));
    }

    public function getNewTrades() {
        $user_id = Auth::user()->id;
        $trades  = Transaction::where('type', 'trade')->where('user_id', $user_id)->get();

        return response()->json($trades);
    }
}

<?php
namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\LockedPack;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class PageBundledPacks extends Controller {
    public function index() {
        $transactions = Transaction::where('user_id', Auth::user()->id)->where('type', 'trade')->orderBy('created_at', 'desc')->get();

        $allBundledPacks      = LockedPack::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $runningBundledPacks  = LockedPack::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->where('status', 'executing')->get();
        $inactiveBundledPacks = LockedPack::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->where('status', 'completed')->get();

        $trades = Transaction::where('user_id', Auth::user()->id)->where('type', 'trade')->get();

        $pnl = [];
        foreach ($trades as $trade) {
            $packAmount = $allBundledPacks->where('id', $trade->strategy_pack_id)->where('status', 'completed')->value('amount');

            if (! isset($pnl[$trade->strategy_pack_id])) {
                $pnl[$trade->strategy_pack_id] = [
                    'amount'     => 0,
                    'percentage' => 0,
                ];
            }

            $pnl[$trade->strategy_pack_id]['amount'] += $trade->amount_in_usd;

            if ($packAmount > 0) {
                $pnl[$trade->strategy_pack_id]['percentage'] += ($pnl[$trade->strategy_pack_id]['amount'] / $packAmount) * 100;
            }
        }

        return view('content.pages.algo.page-bundled-packs', compact('allBundledPacks', 'runningBundledPacks', 'inactiveBundledPacks', 'pnl', 'transactions'));
    }
}

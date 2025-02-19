<?php
namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Algorithm;
use App\Models\StrategyPacks;
use App\Models\UserBalances;

class PageStrategyPacks extends Controller {
    public function index() {
        $strategyPacks = StrategyPacks::all();
        $algorithms    = Algorithm::all();

        $userUsdBalance = UserBalances::where('wallet', 'USD')->value('balance');

        return view('content.pages.algo.page-strategy-packs', compact('strategyPacks', 'algorithms', 'userUsdBalance'));
    }
}

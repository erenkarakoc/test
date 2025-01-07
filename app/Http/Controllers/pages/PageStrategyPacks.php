<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\StrategyPack;

class PageStrategyPacks extends Controller
{
    public function index()
    {
        $strategy_packs = StrategyPack::all();

        return view('content.pages.algo.page-strategy-packs', compact('strategy_packs'));
    }
}

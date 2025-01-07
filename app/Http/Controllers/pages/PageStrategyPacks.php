<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\StrategyPack;

class PageStrategyPacks extends Controller
{
    public function index()
    {
        $strategy_packs = StrategyPack::all();

        return view('content.pages.strategy-packs.page-strategy-packs', compact('strategy_packs'));
    }
}

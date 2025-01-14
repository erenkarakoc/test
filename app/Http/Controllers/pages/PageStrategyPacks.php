<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Algorithm;
use App\Models\StrategyPacks;

class PageStrategyPacks extends Controller
{
    public function index()
    {
        $strategyPacks = StrategyPacks::all();
        $algorithms = Algorithm::all();

        return view('content.pages.algo.page-strategy-packs', compact('strategyPacks', 'algorithms'));
    }
}

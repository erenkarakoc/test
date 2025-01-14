<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Algorithm;
use App\Models\StrategyPacks;
use App\Models\UserBalances;
use Illuminate\Support\Facades\Auth;

class PageAlgorithms extends Controller
{
    public function index()
    {
        $algorithms = Algorithm::all();
        $userBalances = UserBalances::where('user_id', Auth::user()->id)->get();
        $strategyPacks = StrategyPacks::all();

        return view('content.pages.algo.page-algorithms', compact('algorithms', 'userBalances', 'strategyPacks'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\MarketData;
use App\Models\UserBalances;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

abstract class Controller
{
    protected $marketDataPrices = [];

    protected $userTotalBalance = 0.0;

    protected $userTotalLockedBalance = 0.0;

    public function __construct()
    {
        $this->calculateUserTotalBalance();
        $this->shareMarketDataPrices();
    }

    private function calculateUserTotalBalance()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $userId = $user->id;
            $userBalances = UserBalances::where('user_id', $userId)->get();
            $marketDataPrices = MarketData::pluck('price', 'asset')->toArray();

            foreach ($userBalances as $wallet) {
                $price = $marketDataPrices[$wallet['wallet']] ?? 0;
                $this->userTotalBalance += $wallet['balance'] * $price;
                $this->userTotalLockedBalance += $wallet['locked_balance'] * $price;
            }

            View::share('userTotalBalance', $this->userTotalBalance);
            View::share('userTotalLockedBalance', $this->userTotalLockedBalance);
        }
    }

    private function shareMarketDataPrices()
    {
        $this->marketDataPrices = MarketData::pluck('price', 'asset')->toArray();
        View::share('marketDataPrices', $this->marketDataPrices);
    }
}

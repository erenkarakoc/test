<?php

namespace App\Http\Controllers;

use App\Models\MarketData;
use App\Models\UserBalances;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Controller
{
    protected $userTotalBalance = 0.0;

    public function __construct()
    {
        $this->calculateUserBalance();
    }

    private function calculateUserBalance()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $userId = $user->id;
            $userBalances = UserBalances::where('user_id', $userId)->get();
            $marketDataPrices = MarketData::pluck('price', 'asset')->toArray();

            foreach ($userBalances as $wallet) {
                $price = $marketDataPrices[$wallet['wallet']] ?? 0;
                $this->userTotalBalance += $wallet['balance'] * $price;
            }

            View::share('userTotalBalance', $this->userTotalBalance);
        }
    }
}

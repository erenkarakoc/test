<?php

namespace App\Services;

use App\Models\MarketData;
use App\Models\UserBalances;

class UserBalancesService
{
  /**
   * Calculate the authenticated user's total balance with all views.
   */
  public function calculateUserTotalBalance($user_id)
  {
    $userBalances = UserBalances::where('user_id', operator: $user_id)->get();
    $marketDataPrices = MarketData::pluck('price', 'asset')->toArray();
    $totalBalance = 0.0;
    $totalLockedBalance = 0.0;

    foreach ($userBalances as $wallet) {
      $price = $marketDataPrices[$wallet['wallet']] ?? 0;
      $totalBalance += $wallet['balance'] * $price;
      $totalLockedBalance += $wallet['locked_balance'] * $price;
    }

    return [$totalBalance, $totalLockedBalance];
  }
}

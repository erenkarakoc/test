<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\UserBalances;

class UserBalancesController extends Controller
{
    /**
     * Generate assets if they don't exist
     */
    public function generateUserBalances(string $user_id)
    {
        $assets = Asset::all();

        UserBalances::create(
            [
                'user_id' => $user_id,
                'title' => 'Gedzen Token',
                'wallet' => 'GDZ',
                'balance' => 0,
                'locked_balance' => 0,
            ]
        );
        UserBalances::create(
            [
                'user_id' => $user_id,
                'title' => 'US Dollar',
                'wallet' => 'USD',
                'balance' => 0,
                'locked_balance' => 0,
            ]
        );
        foreach ($assets as $asset) {
            UserBalances::create(
                [
                    'user_id' => $user_id,
                    'title' => $asset->title,
                    'wallet' => $asset->symbol,
                    'balance' => 0,
                    'locked_balance' => 0,
                ]
            );
        }
    }

    /**
     * Generate assets if they don't exist
     */
    public function generateAssets()
    {
        $assets = Asset::all();
        $assetsToGenerate = [
            ['title' => 'Tether', 'symbol' => 'USDT'],
            ['title' => 'Tron', 'symbol' => 'TRX'],
            ['title' => 'Bitcoin', 'symbol' => 'BTC'],
            ['title' => 'Ethereum', 'symbol' => 'ETH'],
            ['title' => 'Ethereum Classic', 'symbol' => 'ETC'],
            ['title' => 'Binance Coin', 'symbol' => 'BNB'],
            ['title' => 'Litecoin', 'symbol' => 'LTC'],
        ];

        if ($assets->isEmpty()) {
            foreach ($assetsToGenerate as $newAsset) {
                Asset::create([
                    'title' => $newAsset['title'],
                    'symbol' => $newAsset['symbol'],
                    'min_deposit' => 0,
                    'max_deposit' => 0,
                    'min_withdraw' => 0,
                    'max_withdraw' => 0,
                ]);
            }
        }
    }
}

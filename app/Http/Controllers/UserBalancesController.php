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

        UserBalances::create([
            'user_id' => $user_id,
            'title' => 'Gedzen Token',
            'wallet' => 'GDZ',
            'balance' => 0,
            'locked_balance' => 0,
        ]);
        UserBalances::create([
            'user_id' => $user_id,
            'title' => 'US Dollar',
            'wallet' => 'USD',
            'balance' => 0,
            'locked_balance' => 0,
        ]);

        $tronApi = new TronApiController;

        foreach ($assets as $asset) {
            UserBalances::create([
                'user_id' => $user_id,
                'title' => $asset->title,
                'wallet' => $asset->symbol,
                'balance' => 0,
                'locked_balance' => 0,
            ]);
        }

        // Tron Wallet
        $tronApi->generateTronWalletForUser($user_id);
    }

    /**
     * Generate assets if they don't exist
     */
    public function generateAssets()
    {
        $assets = Asset::all();
        $assetsToGenerate = [
            ['title' => 'Tether', 'symbol' => 'USDT','network' => 'TRC-20'],
            ['title' => 'Tron', 'symbol' => 'TRX','network' => 'TRC-20'],
            ['title' => 'Bitcoin', 'symbol' => 'BTC','network' => 'Bitcoin'],
            ['title' => 'Ethereum', 'symbol' => 'ETH','network' => 'ERC-20'],
            ['title' => 'Ethereum Classic', 'symbol' => 'ETC','network' => 'ERC-20'],
            ['title' => 'Binance Coin', 'symbol' => 'BNB','network' => 'BEP-20'],
            ['title' => 'Litecoin', 'symbol' => 'LTC','network' => 'Litecoin'],
        ];

        if ($assets->isEmpty()) {
            foreach ($assetsToGenerate as $newAsset) {
                Asset::create([
                    'title' => $newAsset['title'],
                    'symbol' => $newAsset['symbol'],
                    'network' => $newAsset['network'],
                ]);
            }
        }
    }
}

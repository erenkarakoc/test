<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Blockchains\BscApiController;
use App\Http\Controllers\Blockchains\TronApiController;
use App\Models\Asset;
use App\Models\UserBalances;

class UserBalancesController extends Controller {
    /**
     * Generate assets if they don't exist
     */
    public function generateUserBalances(string $user_id) {
        $assets = Asset::all();

        UserBalances::create([
            'user_id'        => $user_id,
            'title'          => 'Gedzen Token',
            'wallet'         => 'GDZ',
            'balance'        => 0,
            'locked_balance' => 0,
        ]);
        UserBalances::create([
            'user_id'        => $user_id,
            'title'          => 'US Dollar',
            'wallet'         => 'USD',
            'balance'        => 0,
            'locked_balance' => 0,
        ]);

        foreach ($assets as $asset) {
            UserBalances::create([
                'user_id'        => $user_id,
                'title'          => $asset->title,
                'wallet'         => $asset->symbol,
                'balance'        => 0,
                'locked_balance' => 0,
            ]);
        }

        $tronApi = new TronApiController;
        $bscApi  = new BscApiController;

        $tronApi->generateTronWalletForUser($user_id);
        $bscApi->generateBSCWalletForUser($user_id);
    }
}

<?php

namespace App\Console\Commands;

use App\Models\GeneratedTronWallet;
use App\Models\UserBalances;
use Illuminate\Console\Command;

class addReceivedTronBalanceToUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:received-tron-balance-to-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $generatedWallets = GeneratedTronWallet::where('status', 'received-balance')->get();

        foreach ($generatedWallets as $wallet) {
            $userTrxWallet = UserBalances::where('user_id', $wallet->user_id)
                ->where('wallet', 'TRX')
                ->first();
            $userUsdtWallet = UserBalances::where('user_id', $wallet->user_id)
                ->where('wallet', 'USDT')
                ->first();
            $userTotalWallet = UserBalances::where('user_id', $wallet->user_id)
                ->where('wallet', 'Total')
                ->first();

            if ((float) $wallet->trx_balance) {
                $userTrxWallet->balance += $wallet->trx_balance;
                $userTotalWallet->balance += convertAssetToUsd($wallet->trx_balance, 'TRX');

                $userTrxWallet->save();
                $userTotalWallet->save();
            }

            if ((float) $wallet->usdt_balance) {
                $userUsdtWallet->balance += $wallet->usdt_balance;
                $userTotalWallet->balance += convertAssetToUsd($wallet->usdt_balance, 'USDT');

                $userUsdtWallet->save();
                $userTotalWallet->save();
            }

            $wallet->status = 'paid-user';
            $wallet->save();
        }
    }
}

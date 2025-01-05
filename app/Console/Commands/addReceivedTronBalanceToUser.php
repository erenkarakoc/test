<?php

namespace App\Console\Commands;

use App\Models\GeneratedTronWallet;
use App\Models\UserBalances;
use Illuminate\Console\Command;

class AddReceivedTronBalanceToUser extends Command
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
    protected $description = 'Adds received Tron balances from GeneratedWallet to UserBalance';

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

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

            if ((float) $wallet->trx_balance) {
                $userTrxWallet->balance += $wallet->trx_balance;
                $userTrxWallet->save();
                $wallet->status = 'paid-user';
            }

            if ((float) $wallet->usdt_balance) {
                $userUsdtWallet->balance += $wallet->usdt_balance;
                $userUsdtWallet->save();
                $wallet->status = 'paid-user';
            }

            $wallet->save();
        }

        $this->info('Added received Tron balances to users.');
    }
}

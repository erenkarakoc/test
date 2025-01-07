<?php

namespace App\Console\Commands;

use App\Models\GeneratedTronWallet;
use App\Models\MarketData;
use App\Models\Transaction;
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
            $userId = $wallet->user_id;
            $userTrxWallet = UserBalances::where('user_id', $wallet->user_id)->where('wallet', 'TRX')->first();
            $userUsdtWallet = UserBalances::where('user_id', $wallet->user_id)->where('wallet', 'USDT')->first();
            $transaction = Transaction::where('tnx_id', $wallet->tnx_id)->first();
            $trxPrice = MarketData::where('asset', 'TRX')->value('price');
            $usdtPrice = MarketData::where('asset', 'USDT')->value('price');

            if ((float) $wallet->trx_balance) {
                // Update User Balance
                $userTrxWallet->balance += $wallet->trx_balance;
                $userTrxWallet->save();

                // Update Generated Wallet
                $wallet->status = 'paid-user';
                $wallet->save();

                // Update Transaction
                if ((float) $wallet->trx_balance !== (float) $transaction->amount_in_asset) {
                    $transaction->notes = array_merge($transaction->notes ?? '[]' ?? [], [
                        'We\'ve received a different amount of TRX/USDT than requested initially. Received amount has been added to your wallet.',
                    ]);
                }
                if ($transaction->asset === 'USDT') {
                    $transaction->notes = array_merge($transaction->notes ?? [], [
                        'We\'ve received TRX instead of USDT. Received amount of TRX has been added to your wallet.',
                    ]);
                    $transaction->asset_price = $trxPrice;
                    $transaction->amount_in_usd = $wallet->trx_balance * $trxPrice;
                } else {
                    $transaction->asset_price = $wallet->asset_price;
                    $transaction->amount_in_usd = $wallet->trx_balance * $wallet->asset_price;
                }
                $transaction->amount_in_asset = $wallet->trx_balance;
                $transaction->asset = 'TRX';
                $transaction->asset_balance_after = $userTrxWallet->balance;
                $transaction->total_balance_after = $this->calculateUserTotalBalance($userId);
                $transaction->status = 'completed';
                $transaction->hash_id = $wallet->hash_id;
                $transaction->save();
            }

            if ((float) $wallet->usdt_balance) {
                // Update User Balance
                $userUsdtWallet->balance += $wallet->usdt_balance;
                $userUsdtWallet->save();

                // Update Generated Wallet
                $wallet->status = 'paid-user';
                $wallet->save();

                // Update Transaction
                if ((float) $wallet->usdt_balance !== (float) $transaction->amount_in_asset) {
                    $transaction->notes = array_merge($transaction->notes ?? '[]' ?? [], [
                        'We\'ve received a different amount of TRX/USDT than requested initially. Received amount has been added to your wallet.',
                    ]);
                }
                if ($transaction->asset === 'TRX') {
                    $transaction->notes = array_merge($transaction->notes ?? '[]' ?? [], [
                        'We\'ve received USDT instead of TRX. Received amount of USDT has been added to your wallet.',
                    ]);
                    $transaction->asset_price = $usdtPrice;
                    $transaction->amount_in_usd = $wallet->trx_balance * $usdtPrice;
                } else {
                    $transaction->asset_price = $wallet->asset_price;
                }
                $transaction->amount_in_asset = $wallet->usdt_balance;
                $transaction->amount_in_usd = $wallet->usdt_balance * $wallet->asset_price;
                $transaction->asset = 'USDT';
                $transaction->asset_balance_after = $userTrxWallet->balance;
                $transaction->total_balance_after = $this->calculateUserTotalBalance($userId);
                $transaction->status = 'completed';
                $transaction->hash_id = $wallet->hash_id;
                $transaction->save();
            }
        }

        $this->info('Added received Tron balances to users.');
    }

    /**
     * Helper to calculate user's total balance.
     */
    private function calculateUserTotalBalance($userId)
    {
        $userBalances = UserBalances::where('user_id', $userId)->get();
        $marketDataPrices = MarketData::pluck('price', 'asset')->toArray();
        $totalBalance = 0.0;

        foreach ($userBalances as $wallet) {
            $price = $marketDataPrices[$wallet['wallet']] ?? 0;
            $totalBalance += $wallet['balance'] * $price;
        }

        log($totalBalance);

        return $totalBalance;
    }
}

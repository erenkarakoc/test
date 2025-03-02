<?php
namespace App\Console\Commands\LockedPacks;

use App\Models\Transaction;
use App\Models\UserBalances;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckPendingTradeTransactions extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:pending-trade-transactions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks pending trade transactions';

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle() {
        $transactions = Transaction::where('type', 'trade')->where('status', 'pending')->get();

        foreach ($transactions as $transaction) {
            $transactionCreatedAt = Carbon::parse($transaction->created_at);
            $fiveMinutesAgo       = Carbon::now()->subMinutes(1);

            if ($transactionCreatedAt->lessThanOrEqualTo($fiveMinutesAgo)) {

                $transaction->status = 'completed';

                if ($transaction->amount_in_usd > 0) {
                    $userBalance = UserBalances::where('user_id', $transaction->user_id)
                        ->where('wallet', 'USD')
                        ->first();

                    $userBalance->locked_balance = bcadd($userBalance->locked_balance, $transaction->amount_in_usd, 8);
                    $userBalance->save();
                }

                $transaction->status = 'completed';
                $transaction->save();
            }
        }

        $this->info('Pending transactions checked successfully!');
    }
}

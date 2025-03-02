<?php
namespace App\Console\Commands\LockedPacks;

use App\Models\Transaction;
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

        }

        $this->info('Pending transactions checked successfully!');
    }
}

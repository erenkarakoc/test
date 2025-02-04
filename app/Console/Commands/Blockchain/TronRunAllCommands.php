<?php
namespace App\Console\Commands\Blockchain;

use Illuminate\Console\Command;

class TronRunAllCommands extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tron:run-all-commands';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute all Tron commands';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $this->call('tron:check-wallets');
        $this->call('tron:get-transactions');
        $this->call('tron:check-confirms');
        $this->info('All Tron commands executed successfully.');

        return 0;
    }
}

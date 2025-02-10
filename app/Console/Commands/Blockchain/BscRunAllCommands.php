<?php
namespace App\Console\Commands\Blockchain;

use Illuminate\Console\Command;

class BscRunAllCommands extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bsc:run-all-commands';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute all BSC commands';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $this->call('bsc:check-wallets');
        $this->call('bsc:get-transactions');
        $this->call('bsc:check-confirms');
        $this->info('All BSC commands executed successfully.');

        return 0;
    }
}

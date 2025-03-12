<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunAllCommands extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:all-commands';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute all seed and update commands';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $this->call('seed:countries');
        $this->call('seed:algorithms');
        $this->call('seed:strategy-packs');
        $this->call('seed:assets');
        $this->call('update:market-data');
        $this->info('Seeded database and updated market data successfully.');

        return 0;
    }
}

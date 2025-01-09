<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\CheckGeneratedTronWallets::class,
        Commands\AddReceivedTronBalanceToUser::class,
        Commands\SendReceivedTronBalanceToMainWallet::class,
        Commands\UpdateMarketData::class,
        Commands\SeedCountries::class,
        Commands\SeedAlgorithms::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands'); // Load commands from the /Commands directory
        require base_path('routes/console.php');
    }
}

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
    protected $commands = [];

    /**
     * Define the application's command schedule.
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Tron API Commands
        $schedule->command('check:check-generated-tron-wallets')->everyMinute();
        $schedule->command('add:received-tron-balance-to-user')->everyMinute();
        $schedule->command('update:market-data')->everyMinute();
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

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected $routeMiddleware = [
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ];
}

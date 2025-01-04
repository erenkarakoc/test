<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Example inspiring quote command for testing
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('check:generated-tron-wallets')->everyMinute();
Schedule::command('add:received-tron-balance-to-user')->everyMinute();
Schedule::command('update:market-data')->everyMinute();

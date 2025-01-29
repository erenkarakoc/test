<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('tron:check-wallets')->everyMinute();
Schedule::command('tron:get-transactions')->everyMinute();

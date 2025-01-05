<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('check:generated-tron-wallets')->everyMinute();
Schedule::command('add:received-tron-balance-to-user')->everyMinute();
Schedule::command('send:received-tron-balance-to-main-wallet')->everyMinute();
Schedule::command('update:market-data')->everyMinute();

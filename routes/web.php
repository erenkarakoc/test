<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Assets\AssetsController;
use App\Http\Controllers\AlgorithmController;
use App\Http\Controllers\Blockchains\TronApiController;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\PageAddFunds;
use App\Http\Controllers\pages\PageAlgorithms;
use App\Http\Controllers\pages\PageDashboard;
use App\Http\Controllers\pages\PageStrategyPacks;
use App\Http\Controllers\pages\PageTeam;
use App\Http\Controllers\pages\PageTransactions;
use App\Http\Controllers\pages\PageWallet;
use App\Http\Controllers\pages\user\PageUserProfile;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// locale
Route::get('/lang/{locale}', [LanguageController::class, 'swap']);

// Test
Route::get('/test', [TestController::class, 'test'])->name('test');

// User
Route::middleware(['auth', 'verified'])->group(function () {
    // ///////////////
    // / GET Routes //
    // ///////////////

    // /////////
    // Pages //
    // /////////

    Route::get('/', [PageDashboard::class, 'index'])->name('page-home');
    Route::get('/dashboard', [PageDashboard::class, 'index'])->name('page-dashboard');

    // Pages - Strategy Packs
    Route::get('/strategy-packs', [PageStrategyPacks::class, 'index'])->name('page-strategy-packs');
    // Pages - Algorithms
    Route::get('/algorithms', [PageAlgorithms::class, 'index'])->name('page-algorithms');
    // Pages - Wallet
    Route::get('/wallet', [PageWallet::class, 'index'])->name('page-wallet');
    // Pages - Add Funds
    Route::get('/add-funds', [PageAddFunds::class, 'index'])->name('page-add-funds');
    // Pages - Transactions
    Route::get('/transactions', [PageTransactions::class, 'index'])->name('page-transactions');
    // Pages - Team
    Route::get('/team', [PageTeam::class, 'index'])->name('page-team');
    // Pages - User - Profile
    Route::get('/user/profile', [PageUserProfile::class, 'index'])->name('page-user-profile');

    // /////////////////
    // / POST Routes ///
    // /////////////////

    // Manage Wallet
    Route::post('/add-wallet', [WalletController::class, 'store'])->name('add-wallet');
    Route::post('/update-wallet', [WalletController::class, 'update'])->name('update-wallet');
    Route::post('/remove-wallet', [WalletController::class, 'destroy'])->name('remove-wallet');
    Route::post('/send-funds-request', [WalletController::class, 'sendFundsRequest'])->name('send-funds-request');
    Route::post('/complete-send-funds', [WalletController::class, 'completeSendFunds'])->name('complete-send-funds');

    // Manage User
    Route::post('/user/update-user-profile', [UserController::class, 'update'])->withoutMiddleware('auth');

    // Transactions
    Route::post('/get-transaction-by-id', [TransactionController::class, 'getTransactionById']);
    Route::post('/create-transaction', [TransactionController::class, 'createTransaction']);
    Route::post('/cancel-transaction', [TransactionController::class, 'cancelTransaction']);

    // Algorithms
    Route::post('/calculate-algorithm-summary', [AlgorithmController::class, 'calculateAlgorithmSummary']);
    Route::post('/lock-pack', [AlgorithmController::class, 'lockPack']);

    // Tron API
    Route::post('/create-transaction-for-tron', [TronApiController::class, 'createTransactionForTron'])->name('create-transaction-for-tron');
    Route::post('/generate-tron-wallet', [TronApiController::class, 'generateTronWallet'])->name('generate-new-wallet');
    Route::post('/check-tron-wallet-balance', [TronApiController::class, 'checkTronWalletBalance'])->name('check-tron-wallet-balance');
    Route::post('/get-generated-tron-wallet-by-transaction', [TronApiController::class, 'getGeneratedTronWalletByTransaction'])->name('get-generated-tron-wallet-qr-code');
    Route::get('/test-api', [TestController::class, 'test'])->name('test-api');
});

// Admin Pages
Route::middleware(['auth', 'verified', AdminMiddleware::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('index');

    // Manage Strategies
    Route::prefix('admin/manage-strategies')->name('admin.manage-strategies.')->group(function () {});

    // Manage Assets
    Route::prefix('admin/assets')->name('admin.assets')->group(function () {
        Route::get('/', [AssetsController::class, 'index'])->name('index');
        // Route::post('/add-asset', [AssetsController::class, 'store'])->name('store');
    });
});

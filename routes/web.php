<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Assets\AssetsController;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\PageAddFunds;
use App\Http\Controllers\pages\PageDashboard;
use App\Http\Controllers\pages\PageTeam;
use App\Http\Controllers\pages\PageTransactions;
use App\Http\Controllers\pages\PageWallet;
use App\Http\Controllers\pages\user\PageUserProfile;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TronApiController;
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

    // Pages - Strategies
    Route::get('/strategies', [PageDashboard::class, 'index'])->name('page-strategies');
    // Pages - Wallet
    Route::get('/wallet', [PageWallet::class, 'index'])->name('page-wallet');
    // Pages - Add Funds
    Route::get('/add-funds', [PageAddFunds::class, 'index'])->name('page-add-funds');
    // Pages - Team
    Route::get('/team', [PageTeam::class, 'index'])->name('page-team');
    // Pages - Transactions
    Route::get('/transactions', [PageTransactions::class, 'index'])->name('page-transactions');
    // Pages - User - Profile
    Route::get('/user/profile', [PageUserProfile::class, 'show'])->name('page-user-profile');

    // /////////////////
    // / POST Routes ///
    // /////////////////

    // Manage Wallet
    Route::post('/add-wallet', [WalletController::class, 'store'])->name('add-wallet');
    Route::post('/update-wallet', [WalletController::class, 'update'])->name('update-wallet');
    Route::post('/remove-wallet', [WalletController::class, 'destroy'])->name('remove-wallet');

    // Manage User
    Route::post('/user/update-user-profile', [UserController::class, 'update'])->withoutMiddleware('auth');

    // Transactions
    Route::post('/create-transaction', [TransactionController::class, 'createTransaction']);
    Route::post('/cancel-transaction', [TransactionController::class, 'cancelTransaction']);

    // Tron API
    Route::post('/create-transaction-for-tron', [TronApiController::class, 'createTransactionForTron'])->name('create-transaction-for-tron');
    Route::post('/generate-tron-wallet', [TronApiController::class, 'generateTronWallet'])->name('generate-new-wallet');
    Route::post('/check-tron-wallet-balance', [TronApiController::class, 'checkTronWalletBalance'])->name('check-tron-wallet-balance');
    Route::get('/test-tron-api', [TestController::class, 'test'])->name('test-tron-api');
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

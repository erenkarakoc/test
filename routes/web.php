<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\PageAddFunds;
use App\Http\Controllers\pages\PageDashboard;
use App\Http\Controllers\pages\PageTeam;
use App\Http\Controllers\pages\PageUserProfile;
use App\Http\Controllers\pages\PageWallet;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TronApiController;
use App\Http\Controllers\WalletController;
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
    // Pages -  Balance Pages
    Route::get('/wallet', [PageWallet::class, 'index'])->name('page-wallet');
    // Pages -  Add Funds
    Route::get('/add-funds', [PageAddFunds::class, 'index'])->name('page-add-funds');
    // Pages -  Team
    Route::get('/team', [PageTeam::class, 'index'])->name('page-team');

    // Pages - User - Profile
    Route::get('/user/profile', [PageUserProfile::class, 'show'])->name('profile.show');

    // /////////////////
    // / POST Routes ///
    // /////////////////

    // Manage Wallet
    Route::post('/add-wallet', [WalletController::class, 'store'])->name('add-wallet');
    Route::post('/update-wallet', [WalletController::class, 'update'])->name('update-wallet');
    Route::post('/remove-wallet', [WalletController::class, 'destroy'])->name('remove-wallet');

    // Transactions
    Route::post('/create-transaction', [TransactionController::class, 'createTransaction']);
    Route::post('/cancel-transaction', [TransactionController::class, 'cancelTransaction']);

    // Tron API
    Route::post('/create-transaction-for-tron', [TronApiController::class, 'createTransactionForTron'])->name('create-transaction-for-tron');
    Route::post('/generate-tron-wallet', [TronApiController::class, 'generateTronWallet'])->name('generate-new-wallet');
    Route::post('/check-tron-wallet-balance', [TronApiController::class, 'checkTronWalletBalance'])->name('check-tron-wallet-balance');
    Route::get('/test-tron-api', [TestController::class, 'swapTRXForUSDT'])->name('test-tron-api');
});

// Admin Pages
Route::middleware(['auth', 'verified'])->group(function () {
    // Strategies
    Route::prefix('admin/manage-strategies')->name('admin.manage-strategies.')->group(function () {});

    // Assets
    Route::prefix('admin/manage-assets')->name('admin.manage-assets')->group(function () {
        // Route::get('/', [AssetController::class, 'index'])->name('index');
        // Route::post('/add-asset', [AssetController::class, 'store'])->name('store');
    });
});

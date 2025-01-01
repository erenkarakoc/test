<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\UserBalances;
use Illuminate\Support\Facades\Auth;

class PageWallet extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $assets = Asset::all();
        $wallet = $wallet = $user->wallet ?: [];
        $activeWallets = collect($wallet)->where('active', true);
        $inactiveWallets = collect($wallet)->where('active', false);
        $userBalances = UserBalances::where('user_id', $user->id)->get();

        return view('content.pages.page-wallet', compact('assets', 'wallet', 'activeWallets', 'inactiveWallets', 'userBalances'));
    }
}

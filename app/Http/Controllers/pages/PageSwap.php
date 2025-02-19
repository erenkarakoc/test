<?php
namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\UserBalances;
use Illuminate\Support\Facades\Auth;

class PageSwap extends Controller {
    public function index() {
        $user = Auth::user();

        $assets       = Asset::all();
        $userBalances = UserBalances::where('user_id', $user->id)->get();

        return view('content.pages.page-swap', compact('assets', 'userBalances'));
    }
}

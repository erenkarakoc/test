<?php
namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\UserBalances;
use Illuminate\Support\Facades\Auth;

class SwapModal extends Controller {
    public function index() {
        $user = Auth::user();

        $assets       = Asset::all();
        $userBalances = UserBalances::where('user_id', $user->id)->get();

        return view('components.swap-modal', compact('assets', 'userBalances'));
    }
}

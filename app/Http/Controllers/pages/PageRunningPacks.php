<?php
namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\LockedPack;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class PageRunningPacks extends Controller {
    public function index() {
        $transactions       = Transaction::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        $runningLockedPacks = LockedPack::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->where('status', 'executing')->get();

        return view('content.pages.algo.page-running-packs', compact('transactions', 'runningLockedPacks'));
    }
}

<?php
namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PageTeam extends Controller {
    public function index() {
        $invitedUsers = User::where('ref_user_id', Auth::user()->id)->get();
        $transactions = Transaction::where('user_id', Auth::user()->id)->where('type', 'bonus')->orderBy('created_at', 'desc')->paginate(10);

        return view('content.pages.page-team', compact('invitedUsers', 'transactions'));
    }
}

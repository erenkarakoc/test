<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PageTeam extends Controller
{
    public function index()
    {
        // $user = Auth::user();

        return view('content.pages.page-team');
    }
}

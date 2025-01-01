<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\UserBalances;

class PageDashboard extends Controller
{
    public function index()
    {
        $userBalances = UserBalances::all();

        return view('content.pages.page-dashboard', compact('userBalances'));
    }
}

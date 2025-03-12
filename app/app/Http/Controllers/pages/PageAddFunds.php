<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Asset;

class PageAddFunds extends Controller
{
    public function index()
    {
        $assets = Asset::all();

        return view('content.pages.page-add-funds', compact('assets'));
    }
}

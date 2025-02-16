<?php
namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Asset;

class PageSwap extends Controller {
    public function index() {
        $assets = Asset::whereNotIn('symbol', ['GDZ', 'USD', 'USDT'])->get();

        return view('content.pages.page-swap', compact('assets'));
    }
}

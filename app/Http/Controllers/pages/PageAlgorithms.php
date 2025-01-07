<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Algorithm;

class PageAlgorithms extends Controller
{
    public function index()
    {
        $algorithms = Algorithm::all();

        return view('content.pages.algo.page-algorithms', compact('algorithms'));
    }
}

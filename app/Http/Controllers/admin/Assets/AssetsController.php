<?php

namespace App\Http\Controllers\Admin\Assets;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Asset;

class AssetsController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $assets = Asset::all();

        return view('admin.pages.assets', compact('assets'));
    }
}

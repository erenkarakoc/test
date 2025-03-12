<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;

class VerifyEmail extends Controller
{
    public function index()
    {
        $pageConfigs = ['myLayout' => 'blank'];

        return view('content.authentications.verify-email', ['pageConfigs' => $pageConfigs]);
    }
}

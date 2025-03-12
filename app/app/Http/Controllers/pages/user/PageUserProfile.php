<?php

namespace App\Http\Controllers\pages\user;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class PageUserProfile extends Controller
{
    public function index(Request $request)
    {
        $countries = Country::select('id', 'name', 'translations')->get();

        return view('content.pages.user.page-user-profile', [
            'request' => $request,
            'user' => $request->user(),
            'countries' => $countries,
        ]);
    }
}

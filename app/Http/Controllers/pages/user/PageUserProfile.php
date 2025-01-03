<?php

namespace App\Http\Controllers\pages\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageUserProfile extends Controller
{
    /**
     * Show the user profile screen.
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {

        return view('content.pages.user.page-user-profile', [
            'request' => $request,
            'user' => $request->user(),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Validate and update the given user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:255',
        ]);

        $user->username = $request->username;
        $user->save();

        return response()->json([
            'success' => true,
            'updated_user' => [
                'username' => $user->username,
            ],
        ]);
    }
}

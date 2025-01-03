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
            'username' => 'required|string',
            'full_name' => 'nullable|string',
            'country' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'date_of_birth' => 'nullable|string',
        ]);

        $user->username = $request->username;
        $user->full_name = $request->full_name;
        $user->country = $request->country;
        $user->phone_number = $request->phone_number;
        $user->date_of_birth = $request->date_of_birth;

        $user->save();

        return response()->json([
            'success' => true,
            'updated_user' => [
                'username' => $user->username,
            ],
        ]);
    }
}

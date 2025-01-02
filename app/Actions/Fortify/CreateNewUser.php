<?php

namespace App\Actions\Fortify;

use App\Http\Controllers\UserBalancesController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'username' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'invite_code' => ['nullable', 'string', 'exists:users,ref_code'],
        ])->validate();

        // Generate refCode for user
        do {
            $refCode = strtolower(Str::random(8));
        } while (User::where('ref_code', $refCode)->exists());

        // Get inviter id if invite_code exists
        $refUserId = null;
        if (isset($input['invite_code']) && $input['invite_code']) {
            $refUserId = User::where('ref_code', $input['invite_code'])->value('id');
        }

        // Create the user with ref_user_id if applicable
        $user = User::create([
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'ref_code' => $refCode,
            'ref_user_id' => $refUserId,
        ]);

        $userBalancesController = new UserBalancesController;
        $userBalancesController->generateAssets();
        $userBalancesController->generateUserBalances($user->id);

        return $user;
    }
}

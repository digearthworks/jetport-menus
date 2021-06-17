<?php

namespace App\Auth\Actions;

use App\Auth\Models\User;
use App\Events\User\UserCreated;
use DB;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Log;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Auth\Models\User
     */
    public function create(array $input)
    {
        if (Auth::user() && Auth::user()->isAdmin()) {
            $input['email_verified_at'] = isset($input['email_verified']) && $input['email_verified'] === '1' ? now() : null;
            $input['password_confirmation'] = $input['password'];
            $input['terms'] = 1;
        }

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        DB::beginTransaction();

        try {
            $user = User::create([
                'type' => $input['type'] ?? User::TYPE_USER,
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => $input['password'],
                'provider' => $input['provider'] ?? null,
                'provider_id' => $input['provider_id'] ?? null,
                'email_verified_at' => $input['email_verified_at'] ?? null,
                'active' => $input['active'] ?? true,
            ]);

            $user->syncRoles($input['roles'] ?? []);

            $user->syncMenus($input['menus'] ?? []);
        } catch (Exception $e) {
            DB::rollBack();

            Log::error($e);
        }

        event(new UserCreated($user));

        DB::commit();

        return $user;
    }
}

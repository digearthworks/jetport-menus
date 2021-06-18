<?php

namespace App\Core\Auth\Actions;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function reset($user, array $input)
    {
        Validator::make($input, [
            'password' => array_merge($this->passwordRules(), ['max:100',], PasswordRules::changePassword($user->email))
        ])->validate();

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}

<?php

namespace App\Turbine\Auth\Actions;

use App\Models\User;
use App\Turbine\Auth\Events\User\UserRestored;
use App\Turbine\Exceptions\GeneralException;

class RestoreUserAction
{
    public function __invoke(User $user): User
    {
        if ($user->restore()) {
            event(new UserRestored($user));

            return $user;
        }

        throw new GeneralException(__('There was a problem restoring this user. Please try again.'));
    }
}

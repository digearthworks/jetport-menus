<?php

namespace App\Auth\Actions;

use App\Auth\Models\User;
use App\Events\User\UserRestored;
use App\Exceptions\GeneralException;

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

<?php

namespace App\Core\Auth\Actions;

use App\Core\Auth\Models\User;
use App\Core\Events\User\UserRestored;
use App\Core\Exceptions\GeneralException;

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

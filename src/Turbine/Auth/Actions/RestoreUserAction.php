<?php

namespace Turbine\Auth\Actions;

use Turbine\Auth\Events\User\UserRestored;
use Turbine\Auth\Models\User;
use Turbine\Exceptions\GeneralException;

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

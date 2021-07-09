<?php

namespace Turbine\Auth\Actions;

use Turbine\Auth\Events\User\UserStatusChanged;
use Turbine\Auth\Models\User;
use Turbine\Exceptions\GeneralException;

class ChangeUserStatusAction
{
    public function __invoke(User $user, int $status): User
    {
        if ($status === 0 && auth()->id() === $user->id) {
            throw new GeneralException(__('You can not do that to yourself.'));
        }

        if ($status === 0 && $user->isMasterAdmin()) {
            throw new GeneralException(__('You can not deactivate the administrator account.'));
        }

        $user->active = $status;

        if ($user->save()) {
            event(new UserStatusChanged($user, $status));

            return $user;
        }

        throw new GeneralException(__('There was a problem updating this user. Please try again.'));
    }
}

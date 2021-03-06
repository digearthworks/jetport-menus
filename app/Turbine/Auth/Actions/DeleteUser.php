<?php

namespace App\Turbine\Auth\Actions;

use App\Turbine\Auth\Events\User\UserDeleted;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->syncMenuItems([]);
        $user->delete();

        event(new UserDeleted($user));
    }
}

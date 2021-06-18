<?php

namespace App\Core\Auth\Actions;

use App\Core\Auth\Models\Role;
use App\Core\Events\Role\RoleDeleted;
use App\Core\Exceptions\GeneralException;

class DeleteRoleAction
{
    public function __invoke(Role $role): bool
    {
        if ($role->users()->count()) {
            throw new GeneralException(__('You can not delete a role with associated users.'));
        }

        if ($role->delete()) {
            event(new RoleDeleted($role));

            return true;
        }

        throw new GeneralException(__('There was a problem deleting the role.'));
    }
}

<?php

namespace App\Turbine\Auth\Actions;

use App\Turbine\Auth\Events\Role\RoleDeleted;
use App\Turbine\Auth\Models\Role;
use App\Turbine\Exceptions\GeneralException;

class DeleteRoleAction
{
    public function __invoke(Role $role): bool
    {
        if ($role->users()->count()) {
            throw new GeneralException(__('You can not delete a role with associated users.'));
        }

        if ($role->syncMenuItems([]) && $role->delete()) {
            event(new RoleDeleted($role));

            return true;
        }

        throw new GeneralException(__('There was a problem deleting the role.'));
    }
}

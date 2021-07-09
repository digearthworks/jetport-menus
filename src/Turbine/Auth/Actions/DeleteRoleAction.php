<?php

namespace Turbine\Auth\Actions;

use Turbine\Auth\Events\Role\RoleDeleted;
use Turbine\Auth\Models\Role;
use Turbine\Exceptions\GeneralException;

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

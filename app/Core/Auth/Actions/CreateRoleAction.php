<?php

namespace App\Core\Auth\Actions;

use App\Core\Auth\Models\Role;
use App\Core\Events\Role\RoleCreated;
use App\Core\Exceptions\GeneralException;
use DB;
use Exception;

class CreateRoleAction
{
    public function __invoke(array $data = []): Role
    {
        DB::beginTransaction();

        try {
            $role = Role::create(['type' => $data['type'], 'name' => $data['name']]);
            $role->syncPermissions($data['permissions'] ?? []);
            $role->syncMenus($data['menus'] ?? []);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating the role.'));
        }

        event(new RoleCreated($role));

        DB::commit();

        return $role;
    }
}

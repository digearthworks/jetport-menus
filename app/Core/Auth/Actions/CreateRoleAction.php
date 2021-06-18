<?php

namespace App\Core\Auth\Actions;

use App\Core\Auth\Models\Role;
use App\Core\Events\Role\RoleCreated;
use App\Core\Exceptions\GeneralException;
use DB;
use Exception;
use Illuminate\Validation\Rule;
use Validator;

class CreateRoleAction
{
    public function __invoke(array $data = []): Role
    {

        Validator::make($data, [
            'type' => ['string'],
            'name' => ['required', Rule::unique('roles')],
            'permissions' => ['array'],
            'menus' => ['array'],
        ])->validateWithBag('createdRoleForm');

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

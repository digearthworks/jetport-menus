<?php

namespace Turbine\Auth\Actions;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Enum\Laravel\Rules\EnumRule;
use Turbine\Auth\Enums\UserTypeEnum;
use Turbine\Auth\Events\Role\RoleCreated;
use Turbine\Auth\Models\Role;
use Turbine\Exceptions\GeneralException;

class CreateRoleAction
{
    public function __invoke(array $data = []): Role
    {
        Validator::make($data, [
            'type' => [new EnumRule(UserTypeEnum::class)],
            'name' => ['required', Rule::unique('roles')],
            'permissions' => ['array'],
            'menus' => ['array'],
        ])->validateWithBag('createdRoleForm');

        DB::beginTransaction();

        try {
            $role = Role::create(['type' => $data['type'], 'name' => $data['name']]);
            $role->syncPermissions($data['permissions'] ?? []);
            $role->syncMenusWithChildren($data['menuItems'] ?? []);
        } catch (Exception $e) {
            DB::rollBack();


            if (app()->environment(['local', 'testing'])) {
                throw $e;
            }

            throw new GeneralException(__('There was a problem creating the role.'));
        }

        DB::commit();

        event(new RoleCreated($role));


        return $role;
    }
}

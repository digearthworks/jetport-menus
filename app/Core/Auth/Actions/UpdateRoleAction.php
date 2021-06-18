<?php

namespace App\Core\Auth\Actions;

use App\Core\Auth\Models\Role;
use App\Core\Events\Role\RoleUpdated;
use App\Core\Exceptions\GeneralException;
use DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Validator;

class UpdateRoleAction
{
    public function __invoke(Role $role, array $data = []): Role
    {

        Validator::make($data, [
            'type' => ['string'],
            'name' => [ Rule::unique('roles')->ignore($role->id)],
            'permissions' => ['array'],
            'menus' => ['array'],
        ])->validateWithBag('updateRoleForm');

        DB::beginTransaction();

        try {
            $role->update(['type' => $data['type'], 'name' => $data['name']]);
            $role->syncPermissions($data['permissions'] ?? []);
            $role->syncMenus($data['menus'] ?? []);
        } catch (Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            throw new GeneralException(__('There was a problem updating the role.'));
        }

        event(new RoleUpdated($role));

        DB::commit();

        return $role;
    }
}

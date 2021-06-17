<?php

namespace App\Auth\Actions;

use App\Auth\Models\Role;
use App\Events\Role\RoleUpdated;
use App\Exceptions\GeneralException;
use DB;
use Exception;
use Illuminate\Support\Facades\Log;

class UpdateRoleAction
{
    public function __invoke(Role $role, array $data = []): Role
    {
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

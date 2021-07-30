<?php

namespace App\Turbine\Auth\Actions;

use App\Turbine\Auth\Models\User;
use Illuminate\Support\Facades\Validator;

class UpdateUserPermissionsAction
{
    public function __invoke(User $user, array $input)
    {
        Validator::make($input, [
            'roles' => ['array', 'nullable'],
        ])->validateWithBag('updateRoles');

        if (! $user->isMasterAdmin()) {
            $user->syncRoles($input['roles'] ?? []);
            $user->syncPermissions($input['permissions'] ?? []);
        }
    }
}

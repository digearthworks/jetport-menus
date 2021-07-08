<?php

namespace Turbine\Auth\Actions;

use Illuminate\Support\Facades\Validator;
use Turbine\Auth\Models\User;

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

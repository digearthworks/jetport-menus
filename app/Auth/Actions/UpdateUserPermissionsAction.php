<?php

namespace App\Auth\Actions;

use App\Auth\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;

class UpdateUserPermissionsAction
{
    use AuthorizesRequests;

    public function __invoke(User $user, array $input)
    {
        $this->authorize('admin.access.users');

        Validator::make($input, [
            'roles' => ['array', 'nullable'],
        ])->validateWithBag('updateRoles');

        if (! $user->isMasterAdmin()) {
            $user->syncRoles($input['roles'] ?? []);
            $user->syncPermissions($input['permissions'] ?? []);
        }
    }
}

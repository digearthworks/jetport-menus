<?php

namespace App\Auth\Actions;

use App\Auth\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UpdateUserTypeAction
{
    use AuthorizesRequests;

    public function __invoke(User $user, $type = null)
    {
        $this->authorize('admin.access.users');

        $user->update([
            'type' => $user->isMasterAdmin() ? $this->model::TYPE_ADMIN : $type ?? $user->type,
        ]);
    }
}

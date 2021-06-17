<?php

namespace App\Auth\Actions;

use App\Auth\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UpdateUserMenusAction
{
    use AuthorizesRequests;

    public function __invoke(User $user, array $menus = [])
    {
        $this->authorize('admin.access.users');

        $user->syncMenus($menus);
    }
}

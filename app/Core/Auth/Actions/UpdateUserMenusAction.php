<?php

namespace App\Core\Auth\Actions;

use App\Core\Auth\Models\User;

class UpdateUserMenusAction
{
    public function __invoke(User $user, array $menus = [])
    {
        $user->syncMenus($menus);
    }
}

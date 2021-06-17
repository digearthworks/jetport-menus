<?php

namespace App\Auth\Actions;

use App\Auth\Models\User;

class UpdateUserMenusAction
{
    public function __invoke(User $user, array $menus = [])
    {
        $user->syncMenus($menus);
    }
}

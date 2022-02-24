<?php

namespace App\Turbine\Auth\Actions;

use App\Models\User;

class UpdateUserMenusAction
{
    public function __invoke(User $user, array $menuItems = [])
    {
        $user->syncMenusWithChildren($menuItems);
    }
}

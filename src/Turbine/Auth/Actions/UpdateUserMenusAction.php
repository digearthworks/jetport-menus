<?php

namespace Turbine\Auth\Actions;

use Turbine\Auth\Models\User;

class UpdateUserMenusAction
{
    public function __invoke(User $user, array $menuItems = [])
    {
        $user->syncMenusWithChildren($menuItems);
    }
}

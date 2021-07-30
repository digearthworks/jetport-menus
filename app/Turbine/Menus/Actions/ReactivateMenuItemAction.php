<?php

namespace App\Turbine\Menus\Actions;

use App\Turbine\Menus\Models\MenuItem;

class ReactivateMenuItemAction
{
    public function __invoke(MenuItem $menuItem)
    {
        $menuItem->activate();
    }
}

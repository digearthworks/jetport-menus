<?php

namespace App\Turbine\Menus\Actions;

use App\Turbine\Menus\Models\MenuItem;

class DeactivateMenuItemAction
{
    public function __invoke(MenuItem $menuItem)
    {
        $menuItem->deactivate();
    }
}

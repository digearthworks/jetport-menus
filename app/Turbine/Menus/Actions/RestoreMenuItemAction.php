<?php

namespace App\Turbine\Menus\Actions;

use App\Turbine\Menus\Models\MenuItem;

class RestoreMenuItemAction
{
    public function __invoke(MenuItem $menuItem)
    {
        $menuItem->restore();
    }
}

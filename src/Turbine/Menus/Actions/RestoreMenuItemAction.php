<?php

namespace Turbine\Menus\Actions;

use Turbine\Menus\Models\MenuItem;

class RestoreMenuItemAction
{
    public function __invoke(MenuItem $menuItem)
    {
        $menuItem->restore();
    }
}

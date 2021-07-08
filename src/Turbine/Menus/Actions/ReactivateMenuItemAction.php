<?php

namespace Turbine\Menus\Actions;

use Turbine\Menus\Models\MenuItem;

class ReactivateMenuItemAction
{
    public function __invoke(MenuItem $menuItem)
    {
        $menuItem->activate();
    }
}

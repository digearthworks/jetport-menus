<?php

namespace Turbine\Menus\Actions;

use Turbine\Menus\Models\MenuItem;

class DeactivateMenuItemAction
{
    public function __invoke(MenuItem $menuItem)
    {
        $menuItem->deactivate();
    }
}

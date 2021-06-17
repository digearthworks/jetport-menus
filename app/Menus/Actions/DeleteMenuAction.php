<?php

namespace App\Menus\Actions;

use App\Menus\Models\Menu;

class DeleteMenuAction
{
    public function __invoke(Menu $menu)
    {
        $menu->delete();
    }
}

<?php

namespace App\Menus;

use App\Menus\Contracts\MenuLinkContract;

class MainMenuLink extends MenuLink implements MenuLinkContract
{
    public function getPath() : string
    {
        return $this->menu->path();
    }
}

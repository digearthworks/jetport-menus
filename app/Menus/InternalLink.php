<?php

namespace App\Menus;

use App\Menus\Contracts\MenuLinkContract;

class InternalLink extends MenuLink implements MenuLinkContract
{
    public function getPath() : string
    {
        return '/' . $this->getCleanSlug();
    }
}

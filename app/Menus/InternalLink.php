<?php

namespace App\Menus;

use App\Menus\Contracts\MenuLinkContract;

class InternalLink extends MenuLink implements MenuLinkContract
{
    public function getLink() : string
    {
        return '/' . $this->getCleanSlug();
    }
}

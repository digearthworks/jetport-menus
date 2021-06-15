<?php

namespace App\Menus;

use App\Menus\Contracts\MenuLinkContract;

class DisabledLink extends MenuLink implements MenuLinkContract
{
    public function getLink() : string
    {
        return config('menus.url_segments.disabled_link_prefix') . $this->getCleanSlug();
    }
}

<?php

namespace App\Menus;

use App\Menus\Contracts\MenuLinkContract;

class PageLink extends MenuLink implements MenuLinkContract
{
    public function getPath() : string
    {
        return config('menus.url_segments.pages_prefix') . $this->menu->Page->slug;
    }
}

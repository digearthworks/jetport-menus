<?php

namespace App\Menus;

use App\Menus\Contracts\MenuLinkContract;

class InternalIframeLink extends MenuLink implements MenuLinkContract
{
    public function getLink() : string
    {
        $prefix = config('menus.url_segments.internal_iframe_prefix');

        return '/' . $prefix . (new InternalLink($this->menu))->getLink();
    }
}

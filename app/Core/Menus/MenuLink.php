<?php

namespace App\Core\Menus;

use App\Core\Menus\Contracts\MenuLinkContract;
use App\Core\Menus\Models\Menu;

abstract class MenuLink implements MenuLinkContract
{
    protected $menu;

    public $link;

    public $target;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
        $this->link = $this->getPath();
        $this->target = $this->getTarget();
    }

    public function getPath() : string
    {
        return $this->menu->link;
    }

    public function getTarget(): string
    {
        return '_self';
    }

    protected function getCleanSlug()
    {
        return ltrim(str_replace(array_values(config('menus.url_segments', [])), '', $this->menu->getAttributes()['link']), '/');
    }
}

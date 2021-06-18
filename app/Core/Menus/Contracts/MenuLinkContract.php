<?php

namespace App\Core\Menus\Contracts;

interface MenuLinkContract
{
    public function getPath(): string;

    public function getTarget(): string;
}

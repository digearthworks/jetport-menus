<?php

namespace App\Menus\Contracts;

interface MenuLinkContract
{
    public function getPath(): string;

    public function getTarget(): string;
}

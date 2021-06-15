<?php

namespace App\Menus\Contracts;

interface MenuLinkContract
{
    public function getLink(): string;

    public function getTarget(): string;
}

<?php

namespace App\Turbine\Menus\Models;

use Database\Factories\DropdownLinkFactory;
use App\Turbine\Concerns\HasParent;

class DropdownLink extends MenuItem
{
    use HasParent;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return DropdownLinkFactory::new();
    }
}

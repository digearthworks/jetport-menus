<?php

namespace App\Turbine\Menus\Models;

use App\Turbine\Concerns\HasParent;
use Database\Factories\DropdownLinkFactory;

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

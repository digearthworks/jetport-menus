<?php

namespace App\Turbine\Menus\Models;

use App\Turbine\Concerns\HasParent;
use Database\Factories\MenuLinkFactory;

class MenuLink extends MenuItem
{
    use HasParent;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return MenuLinkFactory::new();
    }

    public function getUriAttribute($value)
    {
        return isset($this->parentItem) ?
            $this->parentItem->getPath() :
            $this->getPath();
    }
}

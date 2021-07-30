<?php

namespace App\Turbine\Menus\Models;

use Database\Factories\InternalLinkFactory;
use HeaderX\BukuIcons\Concerns\HasIcon;
use App\Turbine\Concerns\HasParent;
use App\Turbine\Menus\Casts\InternalLinkUriCast;
use App\Turbine\Menus\Casts\SnakeCast;
use App\Turbine\Menus\Enums\MenuItemTemplateEnum;
use App\Turbine\Menus\Enums\MenuItemTypeEnum;

class InternalLink extends MenuItem
{
    use HasParent;
    use HasIcon;

    protected $casts = [
        'type' => MenuItemTypeEnum::class,
        'template' => MenuItemTemplateEnum::class,
        'active' => 'bool',
        'handle' => SnakeCast::class,
        'uri' => InternalLinkUriCast::class,
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return InternalLinkFactory::new();
    }
}

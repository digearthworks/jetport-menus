<?php

namespace Turbine\Menus\Models;

use Database\Factories\ExternalLinkFactory;
use HeaderX\BukuIcons\Concerns\HasIcon;
use Turbine\Concerns\HasParent;
use Turbine\Menus\Casts\ExternalLinkUriCast;
use Turbine\Menus\Casts\SnakeCast;
use Turbine\Menus\Enums\MenuItemTemplateEnum;
use Turbine\Menus\Enums\MenuItemTypeEnum;

class ExternalLink extends MenuItem
{
    use HasParent;
    use HasIcon;

    protected $casts = [
        'type' => MenuItemTypeEnum::class,
        'template' => MenuItemTemplateEnum::class,
        'active' => 'bool',
        'handle' => SnakeCast::class,
        'uri' => ExternalLinkUriCast::class,
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return ExternalLinkFactory::new();
    }
}

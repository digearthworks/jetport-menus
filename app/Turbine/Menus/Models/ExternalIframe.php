<?php

namespace App\Turbine\Menus\Models;

use Database\Factories\ExternalIframeFactory;
use App\Turbine\Concerns\HasIcon;
use App\Turbine\Concerns\HasParent;
use App\Turbine\Menus\Casts\ExternalIframeUriCast;
use App\Turbine\Menus\Casts\SnakeCast;
use App\Turbine\Menus\Enums\MenuItemTemplateEnum;
use App\Turbine\Menus\Enums\MenuItemTypeEnum;

class ExternalIframe extends MenuItem
{
    use HasParent;
    use HasIcon;

    protected $casts = [
        'type' => MenuItemTypeEnum::class,
        'template' => MenuItemTemplateEnum::class,
        'active' => 'bool',
        'handle' => SnakeCast::class,
        'uri' => ExternalIframeUriCast::class,
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return ExternalIframeFactory::new();
    }
}

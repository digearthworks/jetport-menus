<?php

namespace App\Turbine\Menus\Enums;

use App\Turbine\Menus\Models\DropdownLink;
use App\Turbine\Menus\Models\ExternalIframe;
use App\Turbine\Menus\Models\ExternalLink;
use App\Turbine\Menus\Models\InternalIframe;
use App\Turbine\Menus\Models\InternalLink;
use App\Turbine\Menus\Models\MenuItem;
use App\Turbine\Menus\Models\MenuLink;
use App\Turbine\Menus\Models\PageLink;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self menu_item()
 * @method static self internal_link()
 * @method static self external_link()
 * @method static self internal_iframe()
 * @method static self external_iframe()
 * @method static self page_link()
 * @method static self menu_link()
 * @method static self dropdown_link()
 */
class MenuItemTypeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'menu_item' => MenuItem::class,
            'internal_link' => InternalLink::class,
            'external_link' => ExternalLink::class,
            'internal_iframe' => InternalIframe::class,
            'external_iframe' => ExternalIframe::class,
            'page_link' => PageLink::class,
            'menu_link' => MenuLink::class,
            'dropdown_link' => DropdownLink::class,
        ];
    }
}

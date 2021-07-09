<?php

namespace Turbine\Menus\Enums;

use Spatie\Enum\Laravel\Enum;
use Turbine\Menus\Models\DropdownLink;
use Turbine\Menus\Models\ExternalIframe;
use Turbine\Menus\Models\ExternalLink;
use Turbine\Menus\Models\InternalIframe;
use Turbine\Menus\Models\InternalLink;
use Turbine\Menus\Models\MenuItem;
use Turbine\Menus\Models\MenuLink;
use Turbine\Menus\Models\PageLink;

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

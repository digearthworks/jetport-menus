<?php

namespace Tests\Feature\Menu;

use Tests\TestCase;
use Turbine\Menus\Enums\MenuItemTypeEnum;
use Turbine\Menus\Models\DropdownLink;
use Turbine\Menus\Models\ExternalIframe;
use Turbine\Menus\Models\ExternalLink;
use Turbine\Menus\Models\InternalIframe;
use Turbine\Menus\Models\InternalLink;
use Turbine\Menus\Models\MenuItem;
use Turbine\Menus\Models\MenuLink;
use Turbine\Menus\Models\PageLink;

class MenuItemTest extends TestCase
{
    public function test_it_makes_a_internal_link()
    {
        $link = MenuItem::factory()->internalLink()->create();

        $this->assertEquals(InternalLink::class, get_class(MenuItem::query()->find($link->id)));

        $parent = MenuItem::factory()->create(['type' => MenuItemTypeEnum::menu_item()]);

        $linkFromInternalLinkMethod = $parent->internalLink()->create(MenuItem::factory()->internalLink()->make()->toArray());

        $this->assertEquals(InternalLink::class, get_class(MenuItem::query()->find($linkFromInternalLinkMethod->id)));

        $linkFromChildrenMethod = $parent->children()->create(MenuItem::factory()->internalLink()->make()->toArray());

        $this->assertEquals(InternalLink::class, get_class(MenuItem::query()->find($linkFromChildrenMethod->id)));
    }

    public function test_it_makes_an_external_link()
    {
        $link = MenuItem::factory()->externalLink()->create();

        $this->assertEquals(ExternalLink::class, get_class(MenuItem::query()->find($link->id)));
    }

    public function test_it_makes_a_internal_iframe()
    {
        $link = MenuItem::factory()->internalIframe()->create();

        $this->assertEquals(InternalIframe::class, get_class(MenuItem::query()->find($link->id)));
    }

    public function test_it_makes_an_external_iframe()
    {
        $link = MenuItem::factory()->externalIframe()->create();

        $this->assertEquals(ExternalIframe::class, get_class(MenuItem::query()->find($link->id)));
    }

    public function test_it_makes_a_page_link()
    {
        $link = MenuItem::factory()->pageLink()->create();

        $this->assertEquals(PageLink::class, get_class(MenuItem::query()->find($link->id)));
    }

    public function test_it_makes_a_menu_link()
    {
        $link = MenuItem::factory()->menuLink()->create();

        $this->assertEquals(MenuLink::class, get_class(MenuItem::query()->find($link->id)));
    }

    public function test_it_makes_a_dropdpwn_link()
    {
        $link = MenuItem::factory()->dropdownLink()->create();

        $this->assertEquals(DropdownLink::class, get_class(MenuItem::query()->find($link->id)));
    }

    public function test_it_makes_a_menu_item()
    {
        $link = MenuItem::factory()->create(['type' => MenuItemTypeEnum::menu_item()]);

        $this->assertEquals(MenuItem::class, get_class(MenuItem::query()->find($link->id)));
    }
}

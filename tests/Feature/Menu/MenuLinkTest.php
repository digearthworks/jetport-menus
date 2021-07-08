<?php

namespace Tests\Feature\Menu;

use Tests\TestCase;
use Turbine\Menus\Enums\MenuItemTypeEnum;
use Turbine\Menus\Enums\MenuTemplateEnum;
use Turbine\Menus\Models\Menu;
use Turbine\Menus\Models\MenuItem;

class MenuLinkTest extends TestCase
{
    public function test_it_links_to_a_menu()
    {
        $this->loginAsAdmin();

        $response = $this->get('/' . config('turbine.menus.route_prefix') . '/test-page');

        $response->assertNotFound();

        $this->withoutExceptionHandling();

        $parent = MenuItem::factory()->create([
            'type' => MenuItemTypeEnum::menu_item(),
            'name' => 'test-page',
            'menu_id' => Menu::factory()->create(['template' => MenuTemplateEnum::default()])->id,
        ]);

        $menuLink = MenuItem::factory()->create([
            'parent_id' => $parent->id,
            'uri' => null,
            'type' => MenuItemTypeEnum::menu_link(),
        ]);

        $uri = MenuItem::find($menuLink->id)->uri;

        $this->assertEquals('/' . config('turbine.menus.route_prefix') . '/test-page', $uri);

        $response = $this->get($uri);

        $response->assertOk();
    }
}

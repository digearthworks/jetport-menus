<?php

namespace Tests\Feature\Menu;

use Tests\TestCase;
use App\Turbine\Menus\Enums\MenuItemTypeEnum;
use App\Turbine\Menus\Models\MenuItem;
use App\Turbine\Pages\Models\Page;

class PageLinkTest extends TestCase
{
    public function test_it_links_to_a_page()
    {
        $response = $this->get('/'.config('turbine.pages.route_prefix').'/test-page');

        $response->assertNotFound();

        $page = Page::factory()->create(['slug' => 'test-page']);

        $pageLink = MenuItem::factory()->create([
            'page_id' => $page->id,
            'uri' => null,
            'type' => MenuItemTypeEnum::page_link(),
        ]);

        $uri = MenuItem::find($pageLink->id)->uri;

        $this->assertEquals('/'.config('turbine.pages.route_prefix').'/test-page', $uri);

        $response = $this->get(MenuItem::find($pageLink->id)->uri);

        $response->assertOk();
    }
}

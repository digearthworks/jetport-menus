<?php

namespace Tests\Feature\Menu;

use Tests\TestCase;
use Turbine\Menus\Actions\CreateMenuItemAction;
use Turbine\Menus\Models\MenuItem;

class CreateMenuItemActionTest extends TestCase
{
    public function test_it_creates_a_menu_item()
    {
        $menuItem = (new CreateMenuItemAction)(MenuItem::factory()->make(['name' => 'test-name'])->toArray());

        $this->assertDatabaseHas('menu_items', [
            'name' => 'test-name',
        ]);
    }
}

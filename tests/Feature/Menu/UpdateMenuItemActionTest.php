<?php

namespace Tests\Feature\Menu;

use Tests\TestCase;
use Turbine\Menus\Actions\UpdateMenuItemAction;
use Turbine\Menus\Models\MenuItem;

class UpdateMenuItemActionTest extends TestCase
{
    public function test_it_updates_a_menu_item()
    {
        $menuItem = MenuItem::factory()->create();

        $this->assertDatabaseMissing('menu_items', [
            'id' => $menuItem->id,
            'name' => 'test-menu',
        ]);

        $updatedMenu = (new UpdateMenuItemAction)(['name' => 'test-menu'], $menuItem);

        $this->assertDatabaseHas('menu_items', [
            'id' => $menuItem->id,
            'name' => 'test-menu',
        ]);
    }
}

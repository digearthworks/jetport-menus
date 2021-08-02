<?php

namespace Tests\Feature\Menu;

use App\Turbine\Menus\Actions\UpdateMenuItemAction;
use App\Turbine\Menus\Models\MenuItem;
use Tests\TestCase;

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

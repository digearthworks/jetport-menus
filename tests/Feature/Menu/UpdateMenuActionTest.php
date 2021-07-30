<?php

namespace Tests\Feature\Menu;

use App\Turbine\Menus\Actions\UpdateMenuAction;
use App\Turbine\Menus\Models\Menu;
use Tests\TestCase;

class UpdateMenuActionTest extends TestCase
{
    public function test_it_updates_a_menu()
    {
        $menu = Menu::factory()->create();

        $this->assertDatabaseMissing('menus', [
            'id' => $menu->id,
            'name' => 'test-menu',
        ]);

        $updatedMenu = (new UpdateMenuAction)(['name' => 'test-menu'], $menu);

        $this->assertDatabaseHas('menus', [
            'id' => $menu->id,
            'name' => 'test-menu',
        ]);
    }
}

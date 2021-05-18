<?php

namespace Tests\Feature;

use App\Http\Livewire\DeactivateMenu;
use App\Models\Menu;
use Livewire;
use Tests\TestCase;

class DeactivateMenuTest extends TestCase
{
    /** @test */
    public function a_menu_can_be_deactivated()
    {
        $this->loginAsAdmin();

        $menu = Menu::factory()->create();

        Livewire::test(DeactivateMenu::class)
           ->set('modelId', $menu->id)
           ->call('deactivate');

        $this->assertDatabaseHas('menus', ['id' => $menu->id, 'active' => 0]);
    }

    /** @test */
    public function deactivating_a_menu_will_also_deactivate_its_items()
    {
        $this->loginAsAdmin();

        $parent = Menu::factory()->create(['menu_id' => null, 'active' => 1 ]);

        $child = Menu::factory()->create(['menu_id' => $parent->id, 'active' => 1 ]);

        $this->assertDatabaseHas('menus', ['id' => $parent->id, 'active' => 1]);
        $this->assertDatabaseHas('menus', ['id' => $child->id, 'active' => 1]);

        Livewire::test(DeactivateMenu::class)
           ->set('modelId', $parent->id)
           ->call('deactivate');

        $this->assertDatabaseHas('menus', ['id' => $parent->id, 'active' => 0]);
        $this->assertDatabaseHas('menus', ['id' => $child->id, 'active' => 0]);
    }
}

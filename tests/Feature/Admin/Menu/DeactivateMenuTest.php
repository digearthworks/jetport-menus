<?php

namespace Tests\Feature\Admin\Menu;

use App\Admin\Livewire\Menu\DeactivateMenuDialog;
use App\Menus\Models\Menu;
use Livewire;
use Tests\TestCase;

class DeactivateMenuTest extends TestCase
{
    /** @test */
    public function a_menu_can_be_deactivated()
    {
        $this->loginAsAdmin();

        $menu = Menu::factory()->create();

        Livewire::test(DeactivateMenuDialog::class)
           ->set('modelId', $menu->id)
           ->call('deactivateMenu');

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

        Livewire::test(DeactivateMenuDialog::class)
           ->set('modelId', $parent->id)
           ->call('deactivateMenu');

        $this->assertDatabaseHas('menus', ['id' => $parent->id, 'active' => 0]);
        $this->assertDatabaseHas('menus', ['id' => $child->id, 'active' => 0]);
    }
}

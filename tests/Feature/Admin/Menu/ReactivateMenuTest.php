<?php

namespace Tests\Feature\Admin\Menu;

use App\Admin\Livewire\Menu\ReactivateMenuDialog;
use App\Menus\Models\Menu;
use Livewire;
use Tests\TestCase;

class ReactivateMenuTest extends TestCase
{
    /** @test */
    public function a_menu_can_be_reactvated()
    {
        $this->loginAsAdmin();

        $menu = Menu::factory()->create(['active' => 0]);

        Livewire::test(ReactivateMenuDialog::class)
            ->set('modelId', $menu->id)
            ->call('reactivateMenu');

        $this->assertDatabaseHas('menus', ['id' => $menu->id, 'active' => 1]);
    }

    /** @test */
    public function reactivating_a_menu_will_also_reactivate_its_items()
    {
        $this->loginAsAdmin();

        $parent = Menu::factory()->create(['menu_id' => null]);

        $child = Menu::factory()->create(['menu_id' => $parent->id]);

        $parent->deactivate();
        $child->deactivate();

        $this->assertDatabaseHas('menus', ['id' => $parent->id, 'active' => 0]);
        $this->assertDatabaseHas('menus', ['id' => $child->id, 'active' => 0]);

        Livewire::test(ReactivateMenuDialog::class)
            ->set('modelId', $parent->id)
            ->call('reactivateMenu');

        $this->assertDatabaseHas('menus', ['id' => $parent->id, 'active' => 1]);
        $this->assertDatabaseHas('menus', ['id' => $child->id, 'active' => 1]);
    }

    /** @test */
    public function ractivating_an_item_will_also_reactivate_its_menu()
    {
        $this->loginAsAdmin();

        $parent = Menu::factory()->create(['menu_id' => null]);

        $child = Menu::factory()->create(['menu_id' => $parent->id]);

        $parent->deactivate();
        $child->deactivate();

        $this->assertDatabaseHas('menus', ['id' => $parent->id, 'active' => 0]);
        $this->assertDatabaseHas('menus', ['id' => $child->id, 'active' => 0]);


        Livewire::test(ReactivateMenuDialog::class)
            ->set('modelId', $child->id)
            ->call('reactivateMenu');

        $this->assertDatabaseHas('menus', ['id' => $parent->id, 'active' => 1]);
        $this->assertDatabaseHas('menus', ['id' => $child->id, 'active' => 1]);
    }
}

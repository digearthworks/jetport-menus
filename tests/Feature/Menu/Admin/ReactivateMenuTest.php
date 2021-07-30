<?php

namespace Tests\Feature\Menu\Admin;

use App\Turbine\Menus\Http\Livewire\Admin\ReactivateMenuItemDialog;
use App\Turbine\Menus\Models\MenuItem;
use Livewire\Livewire;
use Tests\TestCase;

class ReactivateMenuTest extends TestCase
{
    /** @test */
    public function a_menu_item_can_be_reactvated()
    {
        $this->loginAsAdmin();

        $menu = MenuItem::factory()->create(['active' => 0]);

        Livewire::test(ReactivateMenuItemDialog::class)
            ->set('modelId', $menu->id)
            ->call('reactivateMenuItem');

        $this->assertDatabaseHas('menu_items', ['id' => $menu->id, 'active' => 1]);
    }

    /** @test */
    public function reactivating_a_menu_item_will_also_reactivate_its_items()
    {
        $this->loginAsAdmin();

        $parent = MenuItem::factory()->create(['parent_id' => null]);

        $child = MenuItem::factory()->create(['parent_id' => $parent->id]);

        $parent->deactivate();
        $child->deactivate();

        $this->assertDatabaseHas('menu_items', ['id' => $parent->id, 'active' => 0]);
        $this->assertDatabaseHas('menu_items', ['id' => $child->id, 'active' => 0]);

        Livewire::test(ReactivateMenuItemDialog::class)
            ->set('modelId', $parent->id)
            ->call('reactivateMenuItem');

        $this->assertDatabaseHas('menu_items', ['id' => $parent->id, 'active' => 1]);
        $this->assertDatabaseHas('menu_items', ['id' => $child->id, 'active' => 1]);
    }

    /** @test */
    public function ractivating_an_item_will_also_reactivate_its_parent()
    {
        $this->loginAsAdmin();

        $parent = MenuItem::factory()->create(['parent_id' => null]);

        $child = MenuItem::factory()->create(['parent_id' => $parent->id]);

        $parent->deactivate();
        $child->deactivate();

        $this->assertDatabaseHas('menu_items', ['id' => $parent->id, 'active' => 0]);
        $this->assertDatabaseHas('menu_items', ['id' => $child->id, 'active' => 0]);


        Livewire::test(ReactivateMenuItemDialog::class)
            ->set('modelId', $child->id)
            ->call('reactivateMenuItem');

        $this->assertDatabaseHas('menu_items', ['id' => $parent->id, 'active' => 1]);
        $this->assertDatabaseHas('menu_items', ['id' => $child->id, 'active' => 1]);
    }
}

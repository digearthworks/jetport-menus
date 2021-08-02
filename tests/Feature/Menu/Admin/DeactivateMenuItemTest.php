<?php

namespace Tests\Feature\Menu\Admin;

use App\Turbine\Menus\Http\Livewire\Admin\DeactivateMenuItemDialog;
use App\Turbine\Menus\Models\MenuItem;
use Livewire\Livewire;
use Tests\TestCase;

class DeactivateMenuItemTest extends TestCase
{
    /** @test */
    public function a_menu_item_can_be_deactivated()
    {
        $this->loginAsAdmin();

        $menuItem = MenuItem::factory()->create();

        Livewire::test(DeactivateMenuItemDialog::class)
           ->set('modelId', $menuItem->id)
           ->call('deactivateMenuItem');

        $this->assertDatabaseHas('menu_items', ['id' => $menuItem->id, 'active' => 0]);
    }

    /** @test */
    public function deactivating_a_menu_item_will_also_deactivate_its_children()
    {
        $this->loginAsAdmin();

        $parent = MenuItem::factory()->create(['parent_id' => null, 'active' => 1 ]);

        $child = MenuItem::factory()->create(['parent_id' => $parent->id, 'active' => 1 ]);

        $this->assertDatabaseHas('menu_items', ['id' => $parent->id, 'active' => 1]);
        $this->assertDatabaseHas('menu_items', ['id' => $child->id, 'active' => 1]);

        Livewire::test(DeactivateMenuItemDialog::class)
           ->set('modelId', $parent->id)
           ->call('deactivateMenuItem');

        $this->assertDatabaseHas('menu_items', ['id' => $parent->id, 'active' => 0]);
        $this->assertDatabaseHas('menu_items', ['id' => $child->id, 'active' => 0]);
    }
}

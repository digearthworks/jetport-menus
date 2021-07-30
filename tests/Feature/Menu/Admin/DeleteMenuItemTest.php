<?php

namespace Tests\Feature\Menu\Admin;

use Livewire\Livewire;
use Tests\TestCase;
use App\Turbine\Menus\Http\Livewire\Admin\DeleteMenuItemDialog;
use App\Turbine\Menus\Models\MenuItem;

class DeleteMenuItemTest extends TestCase
{
    /** @test */
    public function a_menu_item_can_be_deleted()
    {
        $this->loginAsAdmin();

        $menuItem = MenuItem::factory()->create();

        Livewire::test(DeleteMenuItemDialog::class)
           ->set('modelId', $menuItem->id)
           ->call('deleteMenuItem');

        $this->assertSoftDeleted('menu_items', ['id' => $menuItem->id]);
    }

    /** @test */
    public function deleting_a_menu_item_will_also_delete_its_items()
    {
        $this->loginAsAdmin();

        $parent = MenuItem::factory()->create(['parent_id' => null, 'active' => true ]);

        $child = MenuItem::factory()->create(['parent_id' => $parent->id, 'active' => true ]);

        Livewire::test(DeleteMenuItemDialog::class)
           ->set('modelId', $parent->id)
           ->call('deleteMenuItem');

        $this->assertSoftDeleted('menu_items', ['id' => $child->id]);
    }
}

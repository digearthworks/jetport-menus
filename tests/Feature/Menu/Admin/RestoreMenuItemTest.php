<?php

namespace Tests\Feature\Menu\Admin;

use App\Turbine\Menus\Http\Livewire\Admin\RestoreMenuItemDialog;
use App\Turbine\Menus\Models\MenuItem;
use Livewire\Livewire;
use Tests\TestCase;

class RestoreMenuItemTest extends TestCase
{
    /** @test */
    public function a_menu_item_can_be_restored()
    {
        $this->loginAsAdmin();

        $menuItem = MenuItem::factory()->deleted()->create();

        $this->assertSoftDeleted('menu_items', ['id' => $menuItem->id]);

        Livewire::test(RestoreMenuItemDialog::class)
            ->set('modelId', $menuItem->id)
            ->set('withTrashed', true)
            ->call('restoreMenuItem');

        $this->assertDatabaseHas('menu_items', ['id' => $menuItem->id]);
    }

    /** @test */
    public function restoring_a_menu_item_will_also_restore_its_items()
    {
        $this->loginAsAdmin();

        $parent = MenuItem::factory()->create(['parent_id' => null]);

        $child = MenuItem::factory()->create(['parent_id' => $parent->id]);

        $parent->delete();

        $this->assertSoftDeleted('menu_items', ['id' => $child->id]);
        $this->assertSoftDeleted('menu_items', ['id' => $parent->id]);


        Livewire::test(RestoreMenuItemDialog::class)
            ->set('modelId', $parent->id)
            ->set('withTrashed', true)
            ->call('restoreMenuItem');

        $this->assertDatabaseHas('menu_items', ['id' => $child->id]);
    }

    /** @test */
    public function restoring_an_item_will_also_restore_its_menu()
    {
        $this->loginAsAdmin();

        $parent = MenuItem::factory()->create(['parent_id' => null]);

        $child = MenuItem::factory()->create(['parent_id' => $parent->id]);

        $parent->delete();

        $this->assertSoftDeleted('menu_items', ['id' => $parent->id]);
        $this->assertSoftDeleted('menu_items', ['id' => $child->id]);


        Livewire::test(RestoreMenuItemDialog::class)
            ->set('modelId', $child->id)
            ->set('withTrashed', true)
            ->call('restoreMenuItem');

        $this->assertDatabaseHas('menu_items', ['id' => $parent->id]);
    }
}

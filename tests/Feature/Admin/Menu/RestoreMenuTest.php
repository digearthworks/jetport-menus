<?php

namespace Tests\Feature\Admin\Menu;

use App\Http\Livewire\RestoreMenu;
use App\Models\Menu;
use Livewire;
use Tests\TestCase;

class RestoreMenuTest extends TestCase
{
    /** @test */
    public function a_menu_can_be_restored()
    {
        $this->loginAsAdmin();

        $menu = Menu::factory()->deleted()->create();

        $this->assertSoftDeleted('menus', ['id' => $menu->id]);

        Livewire::test(RestoreMenu::class)
            ->set('modelId', $menu->id)
            ->set('withTrashed', true)
            ->call('restore');

        $this->assertDatabaseHas('menus', ['id' => $menu->id]);
    }

    /** @test */
    public function restoring_a_menu_will_also_restore_its_items()
    {
        $this->loginAsAdmin();

        $parent = Menu::factory()->create(['menu_id' => null]);

        $child = Menu::factory()->create(['menu_id' => $parent->id]);

        $parent->delete();

        $this->assertSoftDeleted('menus', ['id' => $child->id]);
        $this->assertSoftDeleted('menus', ['id' => $parent->id]);


        Livewire::test(RestoreMenu::class)
            ->set('modelId', $parent->id)
            ->set('withTrashed', true)
            ->call('restore');

        $this->assertDatabaseHas('menus', ['id' => $child->id]);
    }

    /** @test */
    public function restoring_an_item_will_also_restore_its_menu()
    {
        $this->loginAsAdmin();

        $parent = Menu::factory()->create(['menu_id' => null]);

        $child = Menu::factory()->create(['menu_id' => $parent->id]);

        $parent->delete();

        $this->assertSoftDeleted('menus', ['id' => $child->id]);
        $this->assertSoftDeleted('menus', ['id' => $parent->id]);


        Livewire::test(RestoreMenu::class)
            ->set('modelId', $child->id)
            ->set('withTrashed', true)
            ->call('restore');

        $this->assertDatabaseHas('menus', ['id' => $parent->id]);
    }
}

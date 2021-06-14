<?php

namespace Tests\Feature\Admin\Menu;

use App\Http\Livewire\Admin\Menu\DeleteMenuDialog;
use App\Menus\Models\Menu;
use Livewire;
use Tests\TestCase;

class DeleteMenuTest extends TestCase
{
    /** @test */
    public function a_menu_can_be_deleted()
    {
        $this->loginAsAdmin();

        $menu = Menu::factory()->create();

        Livewire::test(DeleteMenuDialog::class)
           ->set('modelId', $menu->id)
           ->call('deleteMenu');

        $this->assertSoftDeleted('menus', ['id' => $menu->id]);
    }

    /** @test */
    public function deleting_a_menu_will_also_delete_its_items()
    {
        $this->loginAsAdmin();

        $parent = Menu::factory()->create(['menu_id' => null]);

        $child = Menu::factory()->create(['menu_id' => $parent->id]);

        Livewire::test(DeleteMenuDialog::class)
           ->set('modelId', $parent->id)
           ->call('deleteMenu');

        $this->assertSoftDeleted('menus', ['id' => $child->id]);
    }
}

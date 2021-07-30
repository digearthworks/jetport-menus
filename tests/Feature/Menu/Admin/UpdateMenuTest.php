<?php

namespace Tests\Feature\Menu\Admin;

use Livewire\Livewire;
use Tests\TestCase;
use App\Turbine\Menus\Enums\MenuItemTypeEnum;
use App\Turbine\Menus\Http\Livewire\Admin\EditMenuItemForm;
use App\Turbine\Menus\Models\MenuItem;

class UpdateMenuTest extends TestCase
{
    /** @test */
    public function a_menu_item_can_be_updated()
    {
        $this->loginAsAdmin();

        $menuItem = MenuItem::factory()->create(['name' => 'fresh' ]);

        // dd($menuItem);

        $this->assertDatabaseMissing('menus', [
            'type' => 'main_menu',
            'name' => 'Test Menu',
        ]);

        Livewire::test(EditMenuItemForm::class)
            ->set('modelId', $menuItem->id)
            ->set(['state' => [
                'name' => 'test',
                'handle' => 'test',
                'uri' => 'test',
                'type' => MenuItemTypeEnum::menu_item(),
                'template' => 'default',
                'target' => '_self',
                'active' => '1',
                'title' => 'test',
            ]])
            ->call('updateMenu');

        $this->assertDatabaseHas('menu_items', [
            'id' => $menuItem->id,
            'name' => 'test',
            'handle' => 'test',
            'uri' => 'test',
            'type' => MenuItemTypeEnum::menu_item()->value,
            'template' => 'default',
        ]);
    }
}

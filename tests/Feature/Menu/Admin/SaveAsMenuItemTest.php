<?php

namespace Tests\Feature\Menu\Admin;

use App\Turbine\Menus\Enums\MenuItemTypeEnum;
use App\Turbine\Menus\Http\Livewire\Admin\EditMenuItemForm;
use App\Turbine\Menus\Models\MenuItem;
use Livewire\Livewire;
use Tests\TestCase;

class SaveAsMenuItemTest extends TestCase
{
    /** @test */
    public function a_menu_item_can_be_saved_as_a_new_menu()
    {
        // $this->withoutExceptionHandling();

        $this->loginAsAdmin();

        $parent = MenuItem::factory()->active()->create(['parent_id' => null]);
        $child = MenuItem::factory()->active()->create(['parent_id' => $parent->id]);

        $initialCount = MenuItem::count();

        $this->assertDatabaseMissing('menu_items', [
            'name' => 'test',
            'handle' => 'test',
            'uri' => 'test',
            'type' => MenuItemTypeEnum::menu_item()->value,
            'template' => 'default',
            'target' => '_self',
            'active' => '1',
            'title' => 'test',
        ]);

        Livewire::test(EditMenuItemForm::class)
            ->set('modelId', $parent->id)
            ->set(['state' => [
                'name' => 'test',
                'handle' => 'test',
                'uri' => 'test',
                'type' => MenuItemTypeEnum::menu_item()->value,
                'template' => 'default',
                'target' => '_self',
                'active' => '1',
                'title' => 'test',
            ]])
            ->call('saveMenuItemAs');

        $this->assertDatabaseHas('menu_items', [
            'name' => 'test',
            'handle' => 'test',
            'uri' => 'test',
            'type' => MenuItemTypeEnum::menu_item()->value,
        ]);

        $this->assertfalse(
            MenuItem::where('name', 'test')
                ->first()
                ->id == $parent->id
        );

        //two were created 1 parent + 1 child
        $this->assertTrue(MenuItem::count() - $initialCount === 2);
    }
}

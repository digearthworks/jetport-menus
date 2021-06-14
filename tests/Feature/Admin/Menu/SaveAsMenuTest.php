<?php

namespace Tests\Feature\Admin\Menu;

use App\Http\Livewire\Admin\Menu\EditMenuForm;
use App\Icons\Models\Icon;
use App\Menus\Models\Menu;
use Livewire;
use Tests\TestCase;

class SaveAsMenuTest extends TestCase
{
    /** @test */
    public function a_menu_can_be_saved_as_a_new_menu()
    {
        $this->loginAsAdmin();

        $menu = Menu::factory()->create(['menu_id' => null]);
        $child = Menu::factory()->create(['menu_id' => $menu->id]);

        $initialCount = Menu::count();

        $this->assertDatabaseMissing('menus', [
            'type' => 'main_menu',
            'name' => 'Test Menu',
            'handle' => 'Test Menu',
            'group' => 'admin',
            'link' => 'testlink',
        ]);

        Livewire::test(EditMenuForm::class)
            ->set('modelId', $menu->id)
            ->set(['state' => [
                'type' => 'main_menu',
                'name' => 'Test Menu',
                'handle' => 'Test Menu',
                'link' => 'testlink',
                'group' => 'admin',
                'icon_id' => 'fa fa-file',
            ]])
            ->call('saveMenuAs');

        $this->assertDatabaseHas('menus', [
            'type' => 'main_menu',
            'link' => 'testlink',
            'group' => 'admin',
            'icon_id' => Icon::whereClass('fa fa-file')->first()->id,
        ]);

        $this->assertfalse(
            Menu::where('link', 'testlink')
                ->where('icon_id', Icon::whereClass('fa fa-file')
                    ->first()
                    ->id)
                ->first()
                ->id == $menu->id
        );

        //two were created 1 parent + 1 child
        $this->assertTrue(Menu::count() - $initialCount === 2);
    }
}

<?php

namespace Tests\Feature\Admin\Menu;

use App\Http\Livewire\EditMenu;
use App\Models\Icon;
use App\Models\Menu;
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
            'group' => 'admin',
            'link' => 'testlink',
        ]);

        Livewire::test(EditMenu::class)
            ->set('modelId', $menu->id)
            ->set(['form' => [
                'type' => 'main_menu',
                'name' => 'Test Menu',
                'link' => 'testlink',
                'group' => 'admin',
                'icon' => 'fa fa-file',
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

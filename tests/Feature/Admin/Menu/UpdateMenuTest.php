<?php

namespace Tests\Feature\Admin\Menu;

use App\Http\Livewire\Admin\Menu\EditMenuForm;
use App\Models\Icon;
use App\Models\Menu;
use Livewire;
use Tests\TestCase;

class UpdateMenuTest extends TestCase
{
    /** @test */
    public function a_menu_can_be_updated()
    {
        $this->loginAsAdmin();

        $menu = Menu::factory()->create();

        $this->assertDatabaseMissing('menus', [
            'type' => 'main_menu',
            'name' => 'Test Menu',
        ]);

        Livewire::test(EditMenuForm::class)
            ->set('modelId', $menu->id)
            ->set(['state' => [
                'type' => 'main_menu',
                'name' => 'Test Menu',
                'icon' => 'fa fa-file'
            ]])
            ->call('updateMenu');

        $this->assertDatabaseHas('menus', [
            'type' => 'main_menu',
            'name' => 'Test Menu',
            'icon_id' => Icon::whereClass('fa fa-file')->first()->id,
        ]);
    }
}

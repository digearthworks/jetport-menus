<?php

namespace Tests\Feature;

use App\Http\Livewire\CreateMenu;
use App\Models\Icon;
use Livewire;
use Tests\TestCase;

class CreateMenuTest extends TestCase
{
    /** @test */
    public function an_admin_can_access_the_menus_page()
    {
        $this->loginAsAdmin();

        $response = $this->get('/admin/auth/menus');

        $response->assertOk();
    }

    /** @test */
    public function admin_can_create_a_menu()
    {
        $this->loginAsAdmin();

        Livewire::test(CreateMenu::class)
            ->set(['form' => [
                'group' => 'app',
                'name' => 'test',
                'link' => 'test',
                'type' => 'main_menu',
                'active' => '1',
                'title' => 'test',
                'iframe' => '0',
                'sort' => '1',
                'row' => '1',
                'menu_id' => '',
                'icon' => Icon::find(1)->svg,
            ]])
            ->call('create');

        $this->assertDatabaseHas(
            'menus',
            [
                'group' => 'app',
                'name' => 'test',
                'link' => 'test',
                'type' => 'main_menu',
                'icon_id' => 1,
            ]
        );
    }

    /** @test */
    public function create_menu_requires_validation()
    {
        $this->loginAsAdmin();

        Livewire::test(CreateMenu::class)
            ->call('create')
            ->assertHasErrors(['name']);
    }
}

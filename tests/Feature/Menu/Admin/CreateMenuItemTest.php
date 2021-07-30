<?php

namespace Tests\Feature\Menu\Admin;

use Livewire\Livewire;
use Tests\TestCase;
use App\Turbine\Menus\Enums\MenuItemTypeEnum;
use App\Turbine\Menus\Http\Livewire\Admin\CreateMenuItemForm;

class CreateMenuItemTest extends TestCase
{
    /** @test */
    public function an_admin_can_access_the_menus_page()
    {
        $this->loginAsAdmin();

        $this->withoutExceptionHandling();

        $response = $this->get('/admin/menus');

        $response->assertOk();
    }

    /** @test */
    public function admin_can_create_a_menu_item()
    {
        $this->withoutExceptionHandling();
        $this->loginAsAdmin();

        Livewire::test(CreateMenuItemForm::class)
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
            ->call('createMenuItem');

        $this->assertDatabaseHas(
            'menu_items',
            [
                'name' => 'test',
                'handle' => 'test',
                'uri' => 'test',
                'type' => MenuItemTypeEnum::menu_item()->value,
                'template' => 'default',
                'target' => '_self',
                'active' => '1',
                'title' => 'test',
            ]
        );
    }

    /** @test */
    public function create_menu_item_requires_validation()
    {
        $this->loginAsAdmin();

        Livewire::test(CreateMenuItemForm::class)
            ->call('createMenuItem')
            ->assertHasErrors(['handle']);
    }
}

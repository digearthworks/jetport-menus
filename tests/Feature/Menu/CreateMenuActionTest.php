<?php

namespace Tests\Feature\Menu;

use Database\Factories\Concerns\GetsIcons;
use Tests\TestCase;
use Turbine\Menus\Actions\CreateMenuAction;
use Turbine\Menus\Models\Menu;

class CreateMenuActionTest extends TestCase
{
    use GetsIcons;

    public function test_it_creates_a_menu()
    {
        $menu = (new CreateMenuAction)(Menu::factory()->make(['name' => 'test-name'])->toArray());

        $this->assertDatabaseHas('menus', [
            'name' => 'test-name',
        ]);
    }
}

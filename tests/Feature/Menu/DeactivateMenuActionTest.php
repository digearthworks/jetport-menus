<?php

namespace Tests\Feature\Menu;

use Tests\TestCase;
use Turbine\Menus\Actions\DeactivateMenuAction;
use Turbine\Menus\Models\Menu;

class DeactivateMenuActionTest extends TestCase
{
    public function test_it_deactivates_a_menu()
    {
        $menu = Menu::factory()->active()->create();

        $this->assertTrue($menu->active);

        $deactivateMenu = (new DeactivateMenuAction)($menu);

        $this->assertFalse($menu->active);
    }
}

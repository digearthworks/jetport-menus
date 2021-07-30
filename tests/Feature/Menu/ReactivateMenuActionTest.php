<?php

namespace Tests\Feature\Menu;

use Tests\TestCase;
use App\Turbine\Menus\Actions\ReactivateMenuAction;
use App\Turbine\Menus\Models\Menu;

class ReactivateMenuActionTest extends TestCase
{
    public function test_it_reactivates_a_menu()
    {
        $menu = Menu::factory()->inactive()->create();

        $this->assertFalse($menu->active);

        $reactivatedMenu = (new ReactivateMenuAction)($menu);

        $this->assertTrue($menu->active);
    }
}

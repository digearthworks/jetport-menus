<?php

namespace Tests\Feature\Menu;

use Tests\TestCase;
use Turbine\Menus\Actions\ReactivateMenuItemAction;
use Turbine\Menus\Models\MenuItem;

class ReactivateMenuItemActionTest extends TestCase
{
    public function test_it_reactivates_a_menu_item()
    {
        $menuItem = MenuItem::factory()->inactive()->create();

        $this->assertFalse($menuItem->active);

        $reactivatedMenu = (new ReactivateMenuItemAction)($menuItem);

        $this->assertTrue($menuItem->active);
    }
}

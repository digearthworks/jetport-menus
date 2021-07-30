<?php

namespace Tests\Feature\Menu;

use Tests\TestCase;
use App\Turbine\Menus\Actions\DeactivateMenuItemAction;
use App\Turbine\Menus\Models\MenuItem;

class DeleteMenuItemActionTest extends TestCase
{
    public function test_it_deactivates_a_menu_item()
    {
        $menuItem = MenuItem::factory()->active()->create();

        $this->assertTrue($menuItem->active);

        $deactivateMenuItem = (new DeactivateMenuItemAction)($menuItem);

        $this->assertFalse($menuItem->active);
    }
}

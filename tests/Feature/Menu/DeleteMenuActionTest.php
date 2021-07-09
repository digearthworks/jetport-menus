<?php

namespace Tests\Feature\Menu;

use Tests\TestCase;
use Turbine\Menus\Actions\DeleteMenuAction;
use Turbine\Menus\Models\Menu;

class DeleteMenuActionTest extends TestCase
{
    public function test_it_deletes_a_menu()
    {
        $menu = Menu::factory()->create();

        $deletedMenu = (new DeleteMenuAction)($menu);

        $this->assertSoftDeleted($menu);
    }
}

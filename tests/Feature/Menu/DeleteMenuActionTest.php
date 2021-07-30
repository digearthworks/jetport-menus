<?php

namespace Tests\Feature\Menu;

use App\Turbine\Menus\Actions\DeleteMenuAction;
use App\Turbine\Menus\Models\Menu;
use Tests\TestCase;

class DeleteMenuActionTest extends TestCase
{
    public function test_it_deletes_a_menu()
    {
        $menu = Menu::factory()->create();

        $deletedMenu = (new DeleteMenuAction)($menu);

        $this->assertSoftDeleted($menu);
    }
}

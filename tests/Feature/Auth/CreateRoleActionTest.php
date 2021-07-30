<?php

namespace Tests\Feature\Auth;

use App\Turbine\Auth\Actions\CreateRoleAction;
use App\Turbine\Auth\Events\Role\RoleCreated;
use App\Turbine\Auth\Models\Role;
use Event;
use Tests\TestCase;

class CreateRoleActionTest extends TestCase
{
    public function test_it_creates_a_role()
    {
        Event::fake();

        $menuItem = (new CreateRoleAction)(Role::factory()->make(['name' => 'test-name'])->toArray());

        $this->assertDatabaseHas('roles', [
            'name' => 'test-name',
        ]);

        Event::assertDispatched(RoleCreated::class);
    }
}

<?php

namespace Tests\Feature\Auth;

use Event;
use Tests\TestCase;
use Turbine\Auth\Actions\CreateRoleAction;
use Turbine\Auth\Events\Role\RoleCreated;
use Turbine\Auth\Models\Role;

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

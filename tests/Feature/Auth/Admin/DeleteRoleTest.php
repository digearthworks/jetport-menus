<?php

namespace Tests\Feature\Auth\Admin;

use Illuminate\Support\Facades\Event;
use Livewire\Livewire;
use Tests\TestCase;
use Turbine\Auth\Events\Role\RoleDeleted;
use Turbine\Auth\Http\Livewire\DeleteRoleDialog;
use Turbine\Auth\Models\Role;

class DeleteRoleTest extends TestCase
{
    /** @test */
    public function a_role_can_be_deleted()
    {
        Event::fake();

        $this->loginAsAdmin();

        $role = Role::factory()->create();

        Livewire::test(DeleteRoleDialog::class)
            ->set('modelId', $role->id)
            ->call('deleteRole');

        $this->assertDatabaseMissing('roles', ['id' => $role->id]);

        Event::assertDispatched(RoleDeleted::class);
    }
}

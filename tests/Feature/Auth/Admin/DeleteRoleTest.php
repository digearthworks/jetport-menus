<?php

namespace Tests\Feature\Auth\Admin;

use App\Turbine\Auth\Events\Role\RoleDeleted;
use App\Turbine\Auth\Http\Livewire\DeleteRoleDialog;
use App\Turbine\Auth\Models\Role;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;
use Tests\TestCase;

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

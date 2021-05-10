<?php

namespace Tests\Feature;

use App\Events\Role\RoleDeleted;
use App\Http\Livewire\DeleteRole;
use App\Models\Role;
use Illuminate\Support\Facades\Event;
use Livewire;
use Tests\TestCase;

class DeleteRoleTest extends TestCase
{
    /** @test */
    public function a_role_can_be_deleted()
    {
        Event::fake();

        $this->loginAsAdmin();

        $role = Role::factory()->create();

        Livewire::test(DeleteRole::class)
           ->set('roleId', $role->id)
           ->call('deleteRole');

        $this->assertSoftDeleted('roles', ['id' => $role->id]);

        Event::assertDispatched(RoleDeleted::class);
    }
}

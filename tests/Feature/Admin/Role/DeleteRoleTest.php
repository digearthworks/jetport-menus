<?php

namespace Tests\Feature\Admin\Role;

use App\Events\Role\RoleDeleted;
use App\Http\Livewire\Admin\Role\DeleteRoleDialog;
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

        Livewire::test(DeleteRoleDialog::class)
           ->set('modelId', $role->id)
           ->call('deleteRole');

        $this->assertSoftDeleted('roles', ['id' => $role->id]);

        Event::assertDispatched(RoleDeleted::class);
    }
}

<?php

namespace Tests\Feature\Admin\Role;

use App\Core\Auth\Models\Role;
use App\Core\Events\Role\RoleDeleted;
use App\Core\Admin\Livewire\Role\DeleteRoleDialog;
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

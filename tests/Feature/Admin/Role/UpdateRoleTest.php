<?php

namespace Tests\Feature\Admin\Role;

use App\Events\Role\RoleUpdated;
use App\Http\Livewire\Admin\Role\EditRoleForm;
use App\Http\Livewire\EditRole;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Livewire;
use Tests\TestCase;

class UpdateRoleTest extends TestCase
{
    /** @test */
    public function a_role_can_be_updated()
    {
        Event::fake();

        $this->loginAsAdmin();

        $role = Role::factory()->create();


        // Todo: Create Permission Factory
        $permission = Permission::first();

        $this->assertDatabaseMissing('roles', [
            'id' => $role->id,
            'type' => User::TYPE_ADMIN,
            'name' => 'Test Role',
        ]);

        Livewire::test(EditRoleForm::class)
            ->set('modelId', $role->id)
            ->set(['state' => [
                'type' => User::TYPE_ADMIN,
                'name' => 'Test Role',
                'permissions' => [
                    $permission->id
                ],
            ]])
            ->call('updateRole');

        $this->assertDatabaseHas('roles', [
            'id' => $role->id,
            'type' => User::TYPE_ADMIN,
            'name' => 'Test Role',
        ]);

        $this->assertDatabaseHas('role_has_permissions', [
            'permission_id' => $permission->id,
            'role_id' => Role::whereName('Test Role')->first()->id,
        ]);

        Event::assertDispatched(RoleUpdated::class);
    }
}

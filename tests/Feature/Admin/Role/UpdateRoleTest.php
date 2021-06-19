<?php

namespace Tests\Feature\Admin\Role;

use App\Core\Admin\Livewire\Role\EditRoleForm;
use App\Core\Auth\Enums\UserType;
use App\Core\Auth\Models\Permission;
use App\Core\Auth\Models\Role;
use App\Core\Events\Role\RoleUpdated;
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
            'type' => UserType::admin(),
            'name' => 'Test Role',
        ]);

        Livewire::test(EditRoleForm::class)
            ->set('modelId', $role->id)
            ->set(['state' => [
                'type' => UserType::admin(),
                'name' => 'Test Role',
                'permissions' => [
                    $permission->id
                ],
            ]])
            ->call('updateRole');

        $this->assertDatabaseHas('roles', [
            'id' => $role->id,
            'type' => UserType::admin(),
            'name' => 'Test Role',
        ]);

        $this->assertDatabaseHas('role_has_permissions', [
            'permission_id' => $permission->id,
            'role_id' => Role::whereName('Test Role')->first()->id,
        ]);

        Event::assertDispatched(RoleUpdated::class);
    }
}

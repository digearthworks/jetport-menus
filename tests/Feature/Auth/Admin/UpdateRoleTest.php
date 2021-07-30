<?php

namespace Tests\Feature\Auth\Admin;

use App\Turbine\Auth\Enums\UserTypeEnum;
use App\Turbine\Auth\Events\Role\RoleUpdated;
use App\Turbine\Auth\Http\Livewire\EditRoleForm;
use App\Turbine\Auth\Models\Permission;
use App\Turbine\Auth\Models\Role;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;
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
            'type' => UserTypeEnum::admin(),
            'name' => 'Test Role',
        ]);

        Livewire::test(EditRoleForm::class)
            ->set('modelId', $role->id)
            ->set(['state' => [
                'type' => UserTypeEnum::admin(),
                'name' => 'Test Role',
                'permissions' => [
                    $permission->id,
                ],
            ]])
            ->call('updateRole');

        $this->assertDatabaseHas('roles', [
            'id' => $role->id,
            'type' => UserTypeEnum::admin(),
            'name' => 'Test Role',
        ]);

        $this->assertDatabaseHas('role_has_permissions', [
            'permission_id' => $permission->id,
            'role_id' => Role::whereName('Test Role')->first()->id,
        ]);

        Event::assertDispatched(RoleUpdated::class);
    }
}

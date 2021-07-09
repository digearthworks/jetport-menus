<?php

namespace Tests\Feature\Auth\Admin;

use Event;
use Livewire\Livewire;
use Tests\TestCase;
use Turbine\Auth\Enums\UserTypeEnum;
use Turbine\Auth\Events\Role\RoleCreated;
use Turbine\Auth\Http\Livewire\CreateRoleForm;
use Turbine\Auth\Models\Permission;
use Turbine\Auth\Models\Role;

class CreateRoleTest extends TestCase
{
    /** @test */
    public function an_admin_can_access_the_roles_page()
    {
        $this->withoutExceptionHandling();
        $this->loginAsAdmin();

        $response = $this->get('/admin/roles');

        $response->assertOk();
    }

    /** @test */
    public function create_role_requires_validation()
    {
        $this->loginAsAdmin();

        Livewire::test(CreateRoleForm::class)
            ->call('createRole')
            ->assertHasErrors(['name']);
    }

    /** @test */
    public function role_name_needs_to_be_unique()
    {
        $this->loginAsAdmin();

        Role::factory()->create(['name' => 'test']);

        Livewire::test(CreateRoleForm::class)
            ->set('state.name', 'test')
            ->call('createRole')
            ->assertHasErrors(['name']);
    }

    /** @test */
    public function admin_can_create_new_role()
    {
        $this->loginAsAdmin();

        // Todo: Create Permission Factory
        $permission = Permission::first();

        // dd($permission);

        Event::fake();

        Livewire::test(CreateRoleForm::class)
            ->set(['state' => [
                'type' => UserTypeEnum::admin(),
                'name' => 'Test Role',

                'permissions' => [
                    $permission->id,
                ],
            ]])
            ->call('createRole');

        Event::assertDispatched(RoleCreated::class);

        $this->assertDatabaseHas(
            'roles',
            [
                'type' => UserTypeEnum::admin(),
                'name' => 'Test Role',
            ]
        );

        $this->assertDatabaseHas('role_has_permissions', [

            'permission_id' => $permission->id,
            'role_id' => Role::whereName('Test Role')->first()->id,
        ]);
    }
}

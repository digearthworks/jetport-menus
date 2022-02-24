<?php

namespace Tests\Feature\Auth\Admin;

use App\Models\User;
use App\Turbine\Auth\Enums\UserTypeEnum;
use App\Turbine\Auth\Events\User\UserCreated;
use App\Turbine\Auth\Http\Livewire\CreateUserForm;
use App\Turbine\Auth\Models\Role;
use App\Turbine\Menus\Models\MenuItem;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    /** @test */
    public function an_admin_can_access_the_users_page()
    {
        $this->loginAsAdmin();
        // $this->withoutExceptionHandling();

        $response = $this->get('/admin/users');

        $response->assertOk();
    }

    /** @test */
    public function create_user_requires_validation()
    {
        $this->loginAsAdmin();

        Livewire::test(CreateUserForm::class)
            ->call('createUser')
            ->assertHasErrors(['name', 'email']);
    }

    /** @test */
    public function user_email_needs_to_be_unique()
    {
        $this->loginAsAdmin();

        User::factory()->create(['email' => 'john@example.com']);

        Livewire::test(CreateUserForm::class)
            ->set('state.email', 'john@example.com')
            ->call('createUser')
            ->assertHasErrors(['email']);
    }

    /** @test */
    public function admin_can_create_new_user()
    {
        $this->loginAsAdmin();

        $menuItem = MenuItem::factory()->internalLink()->create();

        Event::fake();

        Livewire::test(CreateUserForm::class)
            ->set(['state' => [
                'type' => UserTypeEnum::admin(),
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => 'OC4Nzu270N!QBVi%U%qX',
                'password_confirmation' => 'OC4Nzu270N!QBVi%U%qX',
                'active' => '1',
                'roles' => [
                    Role::whereName(config('turbine.admin.role'))->first()->id,
                ],
                'menuItems' => [
                    $menuItem->id,
                ],
                'permissions' => [],
            ]])
            ->call('createUser');

        $this->assertDatabaseHas(
            'users',
            [
                'type' => UserTypeEnum::admin(),
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'active' => true,
            ]
        );

        $this->assertDatabaseHas('model_has_roles', [
            'role_id' => Role::whereName(config('turbine.admin.role'))->first()->id,
            'model_type' => User::class,
            'model_id' => User::whereEmail('john@example.com')->first()->id,
        ]);

        $this->assertDatabaseHas('menuables', [
            'menuable_id' => User::whereEmail('john@example.com')->first()->id,
            'menuable_type' => User::class,
            'menu_item_id' => $menuItem->id,
        ]);

        Event::assertDispatched(UserCreated::class);
    }

    /** @test */
    public function only_admin_can_create_users()
    {
        $this->actingAs(User::factory()->user()->create());

        $response = $this->get('/admin/users');

        $response->assertSessionHas('flash.banner', __('You do not have access to do that.'));
    }
}

<?php

namespace Tests\Feature\Admin\User;

use App\Auth\Models\Role;
use App\Auth\Models\User;
use App\Events\User\UserCreated;
use App\Admin\Livewire\User\CreateUserForm;
use App\Menus\Models\Menu;
use Illuminate\Support\Facades\Event;
use Livewire;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    /** @test */
    public function an_admin_can_access_the_users_page()
    {
        $this->loginAsAdmin();

        $response = $this->get('/admin/auth/users');

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
        Event::fake();

        $this->loginAsAdmin();

        $menu = Menu::factory()->create();

        Livewire::test(CreateUserForm::class)
            ->set(['state' => [
                'type' => User::TYPE_ADMIN,
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => 'OC4Nzu270N!QBVi%U%qX',
                'password_confirmation' => 'OC4Nzu270N!QBVi%U%qX',
                'active' => '1',
                'roles' => [
                    Role::whereName(config('template.auth.access.role.admin'))->first()->id,
                ],
                'menus' => [
                    $menu->id,
                ],
                'permissions' => [],
            ]])
            ->call('createUser');

        $this->assertDatabaseHas(
            'users',
            [
                'type' => User::TYPE_ADMIN,
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'active' => true,
            ]
        );

        $this->assertDatabaseHas('model_has_roles', [
            'role_id' => Role::whereName(config('template.auth.access.role.admin'))->first()->id,
            'model_type' => User::class,
            'model_id' => User::whereEmail('john@example.com')->first()->id,
        ]);

        $this->assertDatabaseHas('menuables', [
            'menuable_id' => User::whereEmail('john@example.com')->first()->id,
            'menuable_type' => User::class,
            'menu_id' => $menu->id,
        ]);

        Event::assertDispatched(UserCreated::class);
    }

    /** @test */
    public function only_admin_can_create_users()
    {
        $this->actingAs(User::factory()->user()->create());

        $response = $this->get('/admin/auth/users');

        $response->assertSessionHas('flash.banner', __('You do not have access to do that.'));
    }
}

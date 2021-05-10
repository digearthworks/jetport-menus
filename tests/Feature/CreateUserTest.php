<?php

namespace Tests\Feature;

use App\Events\User\UserCreated;
use App\Http\Livewire\CreateUser;
use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
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

        Livewire::test(CreateUser::class)
            ->call('createUser')
            ->assertHasErrors(['name', 'email']);
    }

    /** @test */
    public function user_email_needs_to_be_unique()
    {
        $this->loginAsAdmin();

        User::factory()->create(['email' => 'john@example.com']);

        Livewire::test(CreateUser::class)
            ->set('createUserForm.email', 'john@example.com')
            ->call('createUser')
            ->assertHasErrors(['email']);
    }

    /** @test */
    public function admin_can_create_new_user()
    {
        Event::fake();

        $this->loginAsAdmin();

        $menu = Menu::factory()->create();

        Livewire::test(CreateUser::class)
            ->set(['createUserForm' => [
                'type' => User::TYPE_ADMIN,
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => 'OC4Nzu270N!QBVi%U%qX',
                'password_confirmation' => 'OC4Nzu270N!QBVi%U%qX',
                'active' => '1',
                'roles' => [
                    Role::whereName(config('jetport.auth.access.role.admin'))->first()->id,
                ],
                'menus' => [
                    $menu->id,
                ],
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
            'role_id' => Role::whereName(config('jetport.auth.access.role.admin'))->first()->id,
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

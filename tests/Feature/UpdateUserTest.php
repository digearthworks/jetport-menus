<?php

namespace Tests\Feature;

use App\Events\User\UserUpdated;
use App\Http\Livewire\EditUser;
use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Livewire;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    /** @test */
    public function a_user_can_be_updated()
    {
        Event::fake();

        $this->loginAsAdmin();

        $user = User::factory()->create();

        $menu = Menu::factory()->create();

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'type' => User::TYPE_ADMIN,
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        Livewire::test(EditUser::class)
            ->set('userId', $user->id)
            ->set(['updateUserForm' => [
                'type' => User::TYPE_ADMIN,
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'roles' => [
                    Role::whereName(config('jetport.auth.access.role.admin'))->first()->id,
                ],
                'menus' => [
                    $menu->id,
                ],
                'permissions' => [],
            ]])
            ->call('updateUser');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'type' => User::TYPE_ADMIN,
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

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

        Event::assertDispatched(UserUpdated::class);
    }
}

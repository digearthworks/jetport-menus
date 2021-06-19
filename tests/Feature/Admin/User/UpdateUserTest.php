<?php

namespace Tests\Feature\Admin\User;

use App\Core\Admin\Livewire\User\EditUserForm;
use App\Core\Auth\Enums\UserType;
use App\Core\Auth\Models\Role;
use App\Core\Auth\Models\User;
use App\Core\Events\User\UserUpdated;
use App\Core\Menus\Models\Menu;
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
            'type' => UserType::admin(),
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        Livewire::test(EditUserForm::class)
            ->set('modelId', $user->id)
            ->set(['state' => [
                'type' => UserType::admin(),
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'roles' => [
                    Role::whereName(config('template.auth.access.role.admin'))->first()->id,
                ],
                'menus' => [
                    $menu->id,
                ],
                'permissions' => [],
            ]])
            ->call('updateUser');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'type' => UserType::admin(),
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

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

        Event::assertDispatched(UserUpdated::class);
    }
}

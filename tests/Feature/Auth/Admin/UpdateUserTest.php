<?php

namespace Tests\Feature\Auth\Admin;

use Illuminate\Support\Facades\Event;
use Livewire;
use Tests\TestCase;
use Turbine\Auth\Enums\UserTypeEnum;
use Turbine\Auth\Events\User\UserUpdated;
use Turbine\Auth\Http\Livewire\EditUserForm;
use Turbine\Auth\Models\Role;
use Turbine\Auth\Models\User;
use Turbine\Menus\Models\MenuItem;

class UpdateUserTest extends TestCase
{
    /** @test */
    public function a_user_can_be_updated()
    {
        $this->loginAsAdmin();

        $user = User::factory()->create();

        $menuItem = MenuItem::factory()->internalLink()->create();

        Event::fake();

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'type' => UserTypeEnum::admin(),
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        Livewire::test(EditUserForm::class)
            ->set('modelId', $user->id)
            ->set(['state' => [
                'type' => UserTypeEnum::admin(),
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'roles' => [
                    Role::whereName(config('turbine.admin.role'))->first()->id,
                ],
                'menuItems' => [
                    $menuItem->id,
                ],
                'permissions' => [],
            ]])
            ->call('updateUser');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'type' => UserTypeEnum::admin(),
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

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

        Event::assertDispatched(UserUpdated::class);
    }
}

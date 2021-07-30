<?php

namespace Tests\Feature\Auth\Admin;

use App\Turbine\Auth\Events\User\UserStatusChanged;
use App\Turbine\Auth\Http\Livewire\DeactivateUserDialog;
use App\Turbine\Auth\Http\Livewire\ReactivateUserDialog;
use App\Turbine\Auth\Models\User;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;
use Tests\TestCase;

class DeactivateReactivateUserTest extends TestCase
{
    /** @test */
    public function an_admin_can_access_the_deactivated_users_page()
    {
        $this->withoutExceptionHandling();
        $this->loginAsAdmin();

        $response = $this->get('/admin/users/deactivated');

        $response->assertOk();
    }

    /** @test */
    public function a_user_with_the_correct_permissions_can_reactivate_a_user()
    {
        $this->withoutExceptionHandling();
        Event::fake();

        $this->actingAs($user = User::factory()->admin()->create());

        $user->syncPermissions(['admin.access.users.reactivate']);

        $deactivatedUser = User::factory()->inactive()->create();

        $this->assertDatabaseHas('users', [
            'id' => $deactivatedUser->id,
            'active' => false,
        ]);

        Livewire::test(ReactivateUserDialog::class)
            ->set('modelId', $deactivatedUser->id)
            ->call('reactivateUser');

        $this->assertDatabaseHas('users', [
            'id' => $deactivatedUser->id,
            'active' => true,
        ]);

        Event::assertDispatched(UserStatusChanged::class);
    }

    /** @test */
    public function a_user_with_the_correct_permissions_can_deactivate_a_user()
    {
        Event::fake();

        $this->actingAs($user = User::factory()->admin()->create());

        $user->syncPermissions(['admin.access.users.deactivate']);

        $activeUser = User::factory()->active()->create();

        $this->assertDatabaseHas('users', [
            'id' => $activeUser->id,
            'active' => true,
        ]);

        Livewire::test(DeactivateUserDialog::class)
            ->set('modelId', $activeUser->id)
            ->call('deactivateUser');

        $this->assertDatabaseHas('users', [
            'id' => $activeUser->id,
            'active' => false,
        ]);

        Event::assertDispatched(UserStatusChanged::class);
    }

    /** @test */
    public function a_user_without_the_correct_permissions_can_not_deactivate_a_user()
    {
        $this->actingAs(User::factory()->admin()->create());

        $activeUser = User::factory()->active()->create();

        $this->assertDatabaseHas('users', [
            'id' => $activeUser->id,
            'active' => true,
        ]);

        Livewire::test(DeactivateUserDialog::class)
            ->set('modelId', $activeUser->id)
            ->call('deactivateUser');

        $this->assertDatabaseHas('users', [
            'id' => $activeUser->id,
            'active' => true,
        ]);
    }

    /** @test */
    public function a_user_without_the_correct_permissions_can_not_reactivate_a_user()
    {
        $this->actingAs(User::factory()->admin()->create());

        $deactivatedUser = User::factory()->inactive()->create();

        $this->assertDatabaseHas('users', [
            'id' => $deactivatedUser->id,
            'active' => false,
        ]);

        Livewire::test(ReactivateUserDialog::class)
            ->set('modelId', $deactivatedUser->id)
            ->call('reactivateUser');

        $this->assertDatabaseHas('users', [
            'id' => $deactivatedUser->id,
            'active' => false,
        ]);
    }
}

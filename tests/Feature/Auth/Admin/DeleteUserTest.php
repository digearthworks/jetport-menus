<?php

namespace Tests\Feature\Auth\Admin;

use App\Turbine\Auth\Events\User\UserDeleted;
use App\Turbine\Auth\Http\Livewire\DeleteUserDialog;
use App\Turbine\Auth\Http\Livewire\RestoreUserDialog;
use App\Turbine\Auth\Models\User;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    /** @test */
    public function an_admin_can_access_the_deleted_users_page()
    {
        $this->withoutExceptionHandling();
        $this->loginAsAdmin();

        $response = $this->get('/admin/users/deleted');

        $response->assertOk();
    }

    /** @test */
    public function a_user_can_be_deleted()
    {
        Event::fake();

        $this->loginAsAdmin();

        $user = User::factory()->create();

        Livewire::test(DeleteUserDialog::class)
            ->set('modelId', $user->id)
            ->call('deleteUser');

        $this->assertSoftDeleted('users', ['id' => $user->id]);

        Event::assertDispatched(UserDeleted::class);
    }

    /** @test */
    public function a_user_can_be_restored()
    {
        $this->loginAsAdmin();

        $user = User::factory()->deleted()->create();

        $this->assertSoftDeleted('users', ['id' => $user->id]);

        Livewire::test(RestoreUserDialog::class)
            ->set('modelId', $user->id)
            ->set('withTrashed', true)
            ->call('restoreUser');

        $this->assertDatabaseHas('users', ['id' => $user->id]);
    }
}

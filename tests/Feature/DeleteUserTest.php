<?php

namespace Tests\Feature;

use App\Events\User\UserDeleted;
use App\Http\Livewire\DeletesUser;
use App\Http\Livewire\RestoresUser;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Livewire;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    /** @test */
    public function a_user_can_be_deleted()
    {
        Event::fake();

        $this->loginAsAdmin();

        $user = User::factory()->create();

        Livewire::test(DeletesUser::class)
            ->set('userId', $user->id)
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

        Livewire::test(RestoresUser::class)
            ->set('userId', $user->id)
            ->call('restoreUser');

        $this->assertDatabaseHas('users', ['id' => $user->id]);
    }
}

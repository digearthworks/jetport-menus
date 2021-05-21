<?php

namespace Tests\Feature\Admin\User;

use App\Http\Livewire\Admin\User\EditUserPasswordForm;
use App\Models\User;
use Hash;
use Livewire;
use Tests\TestCase;

class ChangeUserPasswordTest extends TestCase
{
    /** @test */
    public function a_pasword_can_be_updated()
    {
        $this->loginAsAdmin();

        $user = User::factory()->create();

        Livewire::test(EditUserPasswordForm::class)
            ->set('modelId', $user->id)
            ->set('state.password', '1234567')
            ->set('state.password_confirmation', '1234567')
            ->call('updateUserPassword');

        $this->assertTrue(Hash::check('1234567', $user->fresh()->password));
    }

    /** @test */
    public function the_passwords_must_match()
    {
        $this->loginAsAdmin();

        $user = User::factory()->create();

        Livewire::test(EditUserPasswordForm::class)
            ->set('state.password', '1234567')
            ->set('state.password_confirmation', '123456')
            ->call('updateUserPassword')
            ->assertHasErrors(['password']);
    }
}

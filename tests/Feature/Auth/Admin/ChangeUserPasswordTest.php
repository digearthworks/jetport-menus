<?php

namespace Tests\Feature\Auth\Admin;

use App\Models\User;
use App\Turbine\Auth\Http\Livewire\EditUserPasswordForm;
use Hash;
use Livewire\Livewire;
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
            ->set('state.password', 'New-pa55word')
            ->set('state.password_confirmation', 'New-pa55word')
            ->call('updateUserPassword');

        $this->assertTrue(Hash::check('New-pa55word', $user->fresh()->password));
    }

    /** @test */
    public function the_passwords_must_match()
    {
        $this->loginAsAdmin();

        $user = User::factory()->create();

        Livewire::test(EditUserPasswordForm::class)
            ->set('state.password', 'New-pa55word')
            ->set('state.password_confirmation', '123456')
            ->call('updateUserPassword')
            ->assertHasErrors(['password']);
    }
}

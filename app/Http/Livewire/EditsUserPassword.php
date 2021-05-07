<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class EditsUserPassword extends Component
{
    use GetsUser,
        InteractsWithBanner;

    public $userId;

    public $editingUserPassword = false;

    public $updateUserPasswordForm = [
        'password' => '',
        'password_confirmation' => ''
    ];

    public $listeners = ['openEditorForUserPassword'];

    public function openEditorForUserPassword($userId)
    {
        $this->editingUserPassword = true;
        $this->userId = $userId;
    }

    public function updateUserPassword(UserService $users)
    {
        $this->resetErrorBag();
        $validator = Validator::make($this->updateUserPasswordForm, [
            'password' => 'confirmed',
        ]);
        $users->updatePassword($this->getUser($this->userId), $validator->validateWithBag('updatePasswordForm'));
        $this->emit('userPasswordUpdated');
        $this->editingUserPassword = false;
    }

    public function render()
    {
        return view('admin.user.change-password', [
            'user' => $this->getUser($this->userId),
        ]);
    }
}

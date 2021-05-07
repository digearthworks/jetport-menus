<?php

namespace App\Http\Livewire;

use App\Services\UserService;
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
        if ($this->updateUserPasswordForm['password'] != $this->updateUserPasswordForm['password_confirmation']) {
            $this->dangerBanner(__('The Password Confirmation Does Not match'));
            $this->editingUserPassword = false;
            return;
        }
        $users->updatePassword($this->getUser($this->userId), $this->updateUserPasswordForm);
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

<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class EditUserPassword extends Component
{
    use AuthorizesRequests,
        HasUser,
        InteractsWithBanner;

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
        $this->dispatchBrowserEvent('showing-edit-user-password-modal');
    }

    public function updateUserPassword(UserService $users)
    {
        $this->authorize('admin.access.users.change-password');

        $this->resetErrorBag();
        $validator = Validator::make($this->updateUserPasswordForm, [
            'password' => 'confirmed',
        ]);
        $users->updatePassword($this->user, $validator->validateWithBag('updatePasswordForm'));
        $this->emit('userPasswordUpdated');
        $this->editingUserPassword = false;
    }

    public function render()
    {
        return view('admin.users.change-password', [
            'user' => $this->user,
        ]);
    }
}

<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Livewire\Concerns\HasModel;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class EditUserPasswordForm extends Component
{
    use AuthorizesRequests,
        HasModel,
        InteractsWithBanner;

    public $editingUserPassword = false;

    public $eloquentRepository = User::class;

    public $state = [
        'password' => '',
        'password_confirmation' => ''
    ];

    public $listeners = ['openEditorForUserPassword'];

    public function openEditorForUserPassword($userId)
    {
        $this->editingUserPassword = true;
        $this->modelId = $userId;
        $this->dispatchBrowserEvent('showing-edit-user-password-modal');
    }

    public function updateUserPassword(UserService $users)
    {
        $this->authorize('admin.access.users.change-password');

        $this->resetErrorBag();
        $validator = Validator::make($this->state, [
            'password' => 'confirmed',
        ])->validateWithBag('updatePasswordForm');

        $users->updatePassword($this->model, $this->state);
        $this->emit('refreshWithSuccess', 'Successfully changed password for '. $this->model->name);
        $this->editingUserPassword = false;
    }

    public function render()
    {
        return view('admin.users.change-password', [
            'user' => $this->model,
        ]);
    }
}

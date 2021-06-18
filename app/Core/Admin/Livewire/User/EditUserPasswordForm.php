<?php

namespace App\Core\Admin\Livewire\User;

use App\Core\Auth\Models\User;
use App\Core\Livewire\Concerns\HasModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;
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

    public $listeners = ['editPasswordDialog'];

    public function editPasswordDialog($userId): void
    {
        $this->authorize('admin.access.users.change-password');
        $this->editingUserPassword = true;
        $this->modelId = $userId;
        $this->dispatchBrowserEvent('showing-edit-user-password-modal');
    }

    public function updateUserPassword(ResetsUserPasswords $resetsUserPasswords): void
    {
        $this->authorize('admin.access.users.change-password');

        $this->resetErrorBag();
        $validator = Validator::make($this->state, [
            'password' => 'confirmed',
        ])->validateWithBag('updatePasswordForm');

        $resetsUserPasswords->reset($this->model, $this->state);

        $this->emit('refreshWithSuccess', 'Successfully changed password for ' . $this->model->name);
        $this->editingUserPassword = false;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.users.change-password', [
            'user' => $this->model,
        ]);
    }
}

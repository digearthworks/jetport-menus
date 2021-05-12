<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class DeactivateUser extends Component
{
    use AuthorizesRequests,
        HasUser,
        InteractsWithBanner;

    public $confirmingDeactivateUser = false;

    public $listeners = ['confirmDeactivateUser'];

    public function confirmDeactivateUser($userId)
    {
        $this->confirmingDeactivateUser  = true;
        $this->userId = $userId;
        $this->dispatchBrowserEvent('showing-confirm-deactivate-user-modal');
    }

    public function deactivateUser(UserService $users)
    {
        $this->authorize('admin.access.users.deactivate');

        $users->mark($this->user, (int) 0);
        $this->emit('userDeactivated');
        $this->confirmingDeactivateUser = false;
    }

    public function render()
    {
        return view('admin.users.deactivate', [
            'user' => $this->user,
        ]);
    }
}

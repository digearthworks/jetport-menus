<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class ReactivatesUser extends Component
{
    use AuthorizesRequests,
        GetsUser,
        InteractsWithBanner;

    public $userId;

    public $confirmingReactivateUser = false;

    public $listeners = ['confirmReactivateUser'];

    public function confirmReactivateUser($userId)
    {
        $this->confirmingReactivateUser  = true;
        $this->userId = $userId;
        $this->dispatchBrowserEvent('showing-confirm-reactivate-user-modal');
    }

    public function reactivateUser(UserService $users)
    {
        $this->authorize('admin.access.users.reactivate');

        $users->mark($this->getUser($this->userId), (int) 1);
        $this->emit('userReactivated');
        $this->confirmingReactivateUser = false;
    }

    public function render()
    {
        return view('admin.users.reactivate', [
            'user' => $this->getUser($this->userId, true),
        ]);
    }
}

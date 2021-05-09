<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class RestoresUser extends Component
{
    use AuthorizesRequests,
        GetsUser,
        InteractsWithBanner;

    public $userId;

    public $confirmingRestoreUser = false;

    public $listeners = ['confirmRestoreUser'];

    public function confirmRestoreUser($userId)
    {
        $this->confirmingRestoreUser  = true;
        $this->userId = $userId;
        $this->dispatchBrowserEvent('showing-confirm-restore-user-modal');
    }

    public function restoreUser(UserService $users)
    {
        $this->authorize('admin.access.users');

        $users->restore($this->getUser($this->userId, true));
        $this->emit('userRestored');
        $this->confirmingRestoreUser = false;
    }

    public function render()
    {
        return view('admin.users.restore', [
            'user' => $this->getUser($this->userId, true),
        ]);
    }
}

<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class RestoreUser extends Component
{
    use AuthorizesRequests,
        HasUser,
        InteractsWithBanner;

    public $confirmingRestoreUser = false;

    public $listeners = ['confirmRestoreUser'];

    public function confirmRestoreUser($userId)
    {
        $this->confirmingRestoreUser  = true;
        $this->userId = $userId;
        $this->withTrashedUser = true;
        $this->dispatchBrowserEvent('showing-confirm-restore-user-modal');
    }

    public function restoreUser(UserService $users)
    {
        $this->authorize('admin.access.users');

        $users->restore($this->user, true);
        $this->emit('userRestored');
        $this->confirmingRestoreUser = false;
    }

    public function render()
    {
        return view('admin.users.restore', [
            'user' => $this->user,
        ]);
    }
}

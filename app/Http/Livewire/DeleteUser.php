<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class DeleteUser extends Component
{
    use AuthorizesRequests,
        HasUser,
        InteractsWithBanner;

    public $confirmingDeleteUser = false;

    public $listeners = ['confirmDeleteUser'];

    public function confirmDeleteUser($userId)
    {
        $this->confirmingDeleteUser  = true;
        $this->userId = $userId;
        $this->dispatchBrowserEvent('showing-confirm-delete-user-modal');
    }

    public function deleteUser(UserService $users)
    {
        $this->authorize('admin.access.users');

        $users->delete($this->user);
        $this->emit('userDeleted');
        $this->confirmingDeleteUser = false;
    }

    public function render()
    {
        return view('admin.users.delete', [
            'user' => $this->user,
        ]);
    }
}

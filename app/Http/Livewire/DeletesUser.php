<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class DeletesUser extends Component
{
    use GetsUser,
        InteractsWithBanner;

    public $userId;

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
        $users->delete($this->getUser($this->userId));
        $this->emit('userDeleted');
        $this->confirmingDeleteUser = false;
    }

    public function render()
    {
        return view('admin.users.delete', [
            'user' => $this->getUser($this->userId),
        ]);
    }
}

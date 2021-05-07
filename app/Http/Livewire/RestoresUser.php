<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class RestoresUser extends Component
{
    use GetsUser,
        InteractsWithBanner;

    public $userId;

    public $confirmingRestoreUser = false;

    public $listeners = ['confirmRestoreUser'];

    public function confirmRestoreUser($userId)
    {
        $this->confirmingRestoreUser  = true;
        $this->userId = $userId;
    }

    public function restoreUser(UserService $users)
    {
        $users->restore($this->getUser($this->userId, true));
        $this->emit('userRestored');
        $this->confirmingRestoreUser = false;
    }

    public function render()
    {
        return view('admin.user.restore', [
            'user' => $this->getUser($this->userId, true),
        ]);
    }
}

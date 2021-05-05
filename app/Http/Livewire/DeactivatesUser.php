<?php

namespace App\Http\Livewire;

use App\Http\Livewire\GetsUser;
use App\Services\UserService;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class DeactivatesUser extends Component
{
    use GetsUser,
        InteractsWithBanner;

    public $userId;

    public $confirmingDeactivateUser = false;

    public $listeners = ['confirmDeactivateUser'];

    public function confirmDeactivateUser($userId)
    {
        $this->confirmingDeacivateUser  = true;
        $this->userId = $userId;
    }

    public function DeactivateUser(UserService $users)
    {
        $users->mark($this->getUser($this->userId), (int) 0);
        $this->emit('userDeactived');
        $this->confirmingDeactivateUser = false;
    }

    public function render()
    {
        return view('admin.user.deactivate', [
            'user' => $this->getUser($this->userId, true),
        ]);
    }

}

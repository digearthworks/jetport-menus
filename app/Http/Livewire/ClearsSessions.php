<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class ClearsSessions extends Component
{
    use GetsUser,
        InteractsWithBanner;

    public $userId;

    public $confirmingClearSessions = false;

    public $listeners = ['confirmClearSessions'];

    public function confirmClearSessions($userId)
    {
        $this->confirmingClearSessions  = true;
        $this->userId = $userId;
        $this->dispatchBrowserEvent('showing-clear-sessions-modal');
    }

    public function clearSessions(UserService $users)
    {
        $users->clearSessions($this->getUser($this->userId));
        $this->emit('userSessionsCleared');
        $this->confirmingClearSessions = false;
    }

    public function render()
    {
        return view('admin.user.clears-sessions', [
            'user' => $this->getUser($this->userId),
        ]);
    }
}

<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Livewire\Component;

class ClearUserSession extends Component
{
    use HasUser;

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
        $users->clearSessions($this->user);
        $this->emit('userSessionsCleared');
        $this->confirmingClearSessions = false;
    }

    public function render()
    {
        return view('admin.users.clear-sessions', [
            'user' => $this->user,
        ]);
    }
}

<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Livewire\Concerns\HasModel;
use App\Auth\Models\User;
use App\Services\UserService;
use App\Support\Concerns\InteractsWithBanner;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ClearUserSessionDialog extends Component
{
    use AuthorizesRequests,
        HasModel,
        InteractsWithBanner;

    protected $eloquentRepository = User::class;

    public $confirmingClearSessions = false;

    public $listeners = ['confirmClearSessions'];

    public function confirmClearSessions($userId): void
    {
        $this->authorize('admin.access.users.clear-session');
        $this->confirmingClearSessions  = true;
        $this->modelId = $userId;
        $this->dispatchBrowserEvent('showing-clear-sessions-modal');
    }

    public function clearSessions(UserService $users): void
    {
        $this->authorize('admin.access.users.clear-session');
        $users->clearSessions($this->model);
        $this->banner('User Sessions Cleared!');
        $this->confirmingClearSessions = false;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.users.clear-sessions', [
            'user' => $this->model,
        ]);
    }
}

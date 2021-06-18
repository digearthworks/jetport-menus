<?php

namespace App\Core\Admin\Livewire\User;

use App\Core\Auth\Actions\ClearUserSessionsAction;
use App\Core\Auth\Models\User;
use App\Http\Livewire\Concerns\HasModel;
use App\Core\Support\Concerns\InteractsWithBanner;
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

    public function clearSessions(ClearUserSessionsAction $clearUserSessionsAction): void
    {
        $this->authorize('admin.access.users.clear-session');

        $clearUserSessionsAction($this->model);

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

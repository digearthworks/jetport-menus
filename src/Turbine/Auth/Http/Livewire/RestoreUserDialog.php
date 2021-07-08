<?php

namespace Turbine\Auth\Http\Livewire;

use Turbine\Auth\Actions\RestoreUserAction;
use Turbine\Auth\Models\User;
use Turbine\Livewire\BaseRestoreDialog;

class RestoreUserDialog extends BaseRestoreDialog
{
    protected $eloquentRepository = User::class;

    public function restoreUser(RestoreUserAction $restoreUserAction)
    {
        $this->authorize('admin.access.users');

        $restoreUserAction($this->model, true);

        $this->confirmingRestore = false;

        $this->emit('refreshWithSuccess', 'User Restored');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.users.restore', [
            'user' => $this->model,
        ]);
    }
}

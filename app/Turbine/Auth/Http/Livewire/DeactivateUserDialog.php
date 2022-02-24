<?php

namespace App\Turbine\Auth\Http\Livewire;

use App\Models\User;
use App\Turbine\Auth\Actions\ChangeUserStatusAction;
use App\Turbine\Livewire\BaseDeactivateDialog;

class DeactivateUserDialog extends BaseDeactivateDialog
{
    protected $eloquentRepository = User::class;

    public function deactivateUser(ChangeUserStatusAction $changeUserStatusAction)
    {
        $this->authorize('admin.access.users.deactivate');

        $changeUserStatusAction($this->model, (int) 0);

        $this->emit('userDeactivated');

        $this->confirmingDeactivateUser = false;

        $this->emit('refreshWithSuccess', 'User Deactivated');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.users.deactivate', [
            'user' => $this->model,
        ]);
    }
}

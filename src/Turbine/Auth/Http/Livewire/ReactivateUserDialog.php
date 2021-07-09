<?php

namespace Turbine\Auth\Http\Livewire;

use Turbine\Auth\Actions\ChangeUserStatusAction;
use Turbine\Auth\Models\User;
use Turbine\Livewire\BaseReactivateDialog;

class ReactivateUserDialog extends BaseReactivateDialog
{
    protected $eloquentRepository = User::class;

    public function reactivateUser(ChangeUserStatusAction $changeUserStatusAction)
    {
        $this->authorize('admin.access.users.reactivate');

        $changeUserStatusAction($this->model, (int) 1);

        $this->emit('userReactivated');

        $this->confirmingReactivate = false;

        $this->emit('refreshWithSuccess', 'User Reactivated');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.users.reactivate', [
            'user' => $this->model,
        ]);
    }
}

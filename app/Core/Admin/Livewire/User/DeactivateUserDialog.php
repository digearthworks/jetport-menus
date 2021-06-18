<?php

namespace App\Core\Admin\Livewire\User;

use App\Core\Auth\Actions\ChangeUserStatusAction;
use App\Core\Auth\Models\User;
use App\Core\Livewire\BaseDeactivateDialog;

class DeactivateUserDialog extends BaseDeactivateDialog
{
    protected $eloquentRepository = User::class;

    public function deactivateUser(ChangeUserStatusAction $changeUserStatusAction)
    {
        $this->authorize('admin.access.users.deactivate');

        $changeUserStatusAction($this->model, (int) 0);

        $this->emit('userDeactivated');

        $this->confirmingDeactivateUser = false;

        session()->flash('flash.banner', 'User Deactivated!');
        session()->flash('falsh.bannerStyle', 'success');

        return redirect()->route('admin.users.deactivated');
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

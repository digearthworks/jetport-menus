<?php

namespace App\Core\Admin\Livewire\User;

use App\Core\Auth\Actions\ChangeUserStatusAction;
use App\Core\Auth\Models\User;
use App\Core\Livewire\BaseReactivateDialog;

class ReactivateUserDialog extends BaseReactivateDialog
{
    protected $eloquentRepository = User::class;

    public function reactivateUser(ChangeUserStatusAction $changeUserStatusAction)
    {
        $this->authorize('admin.access.users.reactivate');

        $changeUserStatusAction($this->model, (int) 1);

        $this->emit('userReactivated');

        $this->confirmingReactivate = false;

        session()->flash('flash.banner', 'User Reactivated!');
        session()->flash('falsh.bannerStyle', 'success');

        return redirect()->route('admin.users');
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

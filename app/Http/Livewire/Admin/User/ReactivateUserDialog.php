<?php

namespace App\Http\Livewire\Admin\User;

use App\Auth\Actions\ChangeUserStatusAction;
use App\Auth\Models\User;
use App\Http\Livewire\BaseReactivateDialog;

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

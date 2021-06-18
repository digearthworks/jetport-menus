<?php

namespace App\Core\Admin\Livewire\User;

use App\Core\Livewire\BaseCreateButton;

class CreateUserButton extends BaseCreateButton
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.users.create-user-button');
    }
}

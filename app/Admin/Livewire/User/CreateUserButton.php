<?php

namespace App\Admin\Livewire\User;

use App\Http\Livewire\BaseCreateButton;

class CreateUserButton extends BaseCreateButton
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.users.includes.partials.create-user-button');
    }
}

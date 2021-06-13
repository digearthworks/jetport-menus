<?php

namespace App\Http\Livewire\Admin\Role;

use App\Http\Livewire\BaseCreateButton;

class CreateRoleButton extends BaseCreateButton
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.roles.includes.partials.create-role-button');
    }
}

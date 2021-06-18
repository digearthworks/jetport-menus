<?php

namespace App\Core\Admin\Livewire\Role;

use App\Core\Livewire\BaseCreateButton;

class CreateRoleButton extends BaseCreateButton
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.roles.create-role-button');
    }
}

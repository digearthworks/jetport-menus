<?php

namespace Turbine\Auth\Http\Livewire;

use Turbine\Livewire\BaseCreateButton;

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

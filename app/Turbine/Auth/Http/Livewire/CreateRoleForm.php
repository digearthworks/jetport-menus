<?php

namespace App\Turbine\Auth\Http\Livewire;

use App\Turbine\Auth\Actions\CreateRoleAction;
use App\Turbine\Livewire\BaseCreateForm;

class CreateRoleForm extends BaseCreateForm
{

    /**
     * The create form state.
     *
     * @var array
     */
    public $state = [
        'type' => 'user',
        'name' => '',
        'permissions' => [],
        'menuItems' => [],
    ];

    public function createRole(CreateRoleAction $createRoleAction): void
    {
        $this->resetErrorBag();

        $createRoleAction($this->state);

        $this->emit('refreshWithSuccess', 'Role Created!');
        $this->creatingResource = false;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.roles.create');
    }
}

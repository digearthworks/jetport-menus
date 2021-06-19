<?php

namespace App\Core\Admin\Livewire\Role;

use App\Core\Auth\Actions\CreateRoleAction;
use App\Core\Livewire\BaseCreateForm;

class CreateRoleForm extends BaseCreateForm
{

    /**
     * The create form state.
     *
     * @var array
     */
    public $state= [
        'type' => 'user',
        'name' => '',
        'permissions' => [],
        'menus' => [],
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

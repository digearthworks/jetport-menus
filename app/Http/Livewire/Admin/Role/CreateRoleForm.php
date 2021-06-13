<?php

namespace App\Http\Livewire\Admin\Role;

use App\Http\Livewire\BaseCreateForm;
use App\Services\RoleService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

    public function createRole(RoleService $roles): void
    {
        $this->resetErrorBag();

        Validator::make($this->state, [
            'type' => ['string'],
            'name' => ['required', Rule::unique($roles->getTableName())],
            'permissions' => ['array'],
            'menus' => ['array'],
        ])->validateWithBag('createdRoleForm');

        $roles->store($this->state);
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

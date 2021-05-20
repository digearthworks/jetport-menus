<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Livewire\Admin\BaseEditForm;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EditUserForm extends BaseEditForm
{
    protected $eloquentRepository = User::class;

    public array $state = [
        'type' => 'user',
        'name' => '',
        'first_name' => '',
        'last_name' => '',
        'middle_initial' => '',
        'email' => '',
        'password' => '',
        'active' => '',
        'menus' => [],
        'roles' => [],
        'permissions' => [],
    ];


    public function editDialog($resourceId, $params = null)
    {
        $this->editingResource = true;
        $this->modelId = $resourceId;
        $this->state['type'] = $this->model->type;
        $this->state['name'] = $this->model->name;
        $this->state['first_name'] = $this->model->first_name;
        $this->state['last_name'] = $this->model->last_name;
        $this->state['middle_initial'] = $this->model->middle_initail;
        $this->state['email'] = $this->model->email;
        $this->state['password'] = $this->model->password;
        $this->state['active'] = $this->model->active;
        $this->state['menus'] = array_map('strVal', $this->model->menus()->pluck('id')->toArray());
        $this->state['roles'] = array_map('strVal', $this->model->roles()->pluck('id')->toArray());
        $this->state['permissions'] = array_map('strVal', $this->model->getDirectPermissions()->pluck('id')->toArray());
        $this->dispatchBrowserEvent('showing-edit-modal');
    }

    public function updateUser(UserService $users)
    {
        $this->authorize('admin.access.users');

        $this->resetErrorBag();

        Validator::make($this->state, [
            'type' => ['string'],
            'name' => ['required'],
            'email' => ['required', 'email', 'max:255', Rule::unique($users->getTableName())->ignore($this->modelId)],
            'active' => ['integer'],
            'roles' => ['array'],
            'permissions' => ['array'],
            'menus' => ['array'],
            'send_confirmation_email' => ['integer'],
            'email_verified' => ['integer'],
        ])->validateWithBag('updatedUserForm');

        $users->update($this->model, $this->state);
        $this->emit('refreshWithSuccess', 'User Updated');
        $this->editingResource = false;
    }

    public function render()
    {
        return view('admin.users.edit', [
            'user' => $this->model,
        ]);
    }
}

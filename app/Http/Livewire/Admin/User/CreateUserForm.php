<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Livewire\Admin\BaseCreateForm;
use App\Services\UserService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CreateUserForm extends BaseCreateForm
{
    public array $state = [
        'type' => 'user',
        'name' => '',
        'first_name' => '',
        'last_name' => '',
        'middle_initial' => '',
        'email' => '',
        'password' => '',
        'active' => '1',
        'menus' => [],
        'roles' => [],
        'permissions' => [],
        'send_confirmation_email' => '0',
        'email_verified' => '1',
    ];

    public function createUser(UserService $users)
    {
        $this->authorize('admin.access.users');

        $this->resetErrorBag();

        Validator::make($this->state, [
            'type' => ['string'],
            'name' => ['required'],
            'email' => ['required','email', 'max:255', Rule::unique($users->getTableName())],
            'password' => ['required'],
            'active' => ['integer'],
            'roles' => ['array'],
            'permissions' => ['array'],
            'menus' => ['array'],
            'send_confirmation_email' => ['integer'],
            'email_verified' => ['integer'],
        ])->validateWithBag('creatUserForm');

        $users->store($this->state);
        $this->emit('closeCreateDialog');
        $this->emit('refreshWithSuccess', 'User Created');
        $this->creatingResource = false;
    }

    public function render()
    {
        return view('admin.users.create');
    }
}

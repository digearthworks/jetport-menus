<?php

namespace App\Turbine\Auth\Http\Livewire;

use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Turbine\Auth\Concerns\GetsAuthConnection;
use App\Turbine\Livewire\BaseCreateForm;

class CreateUserForm extends BaseCreateForm
{
    use GetsAuthConnection;

    public array $state = [
        'type' => 'user',
        'name' => '',
        'first_name' => '',
        'last_name' => '',
        'middle_initial' => '',
        'email' => '',
        'password' => '',
        'active' => '1',
        'menuItems' => [],
        'roles' => [],
        'permissions' => [],
        'send_confirmation_email' => '0',
        'email_verified' => '1',
    ];

    public function createUser(CreatesNewUsers $createsNewUsers): void
    {
        $this->authorize('admin.access.users');

        $this->resetErrorBag();

        $createsNewUsers->create($this->state);

        $this->emit('closeCreateDialog');
        $this->emit('refreshWithSuccess', 'User Created');
        $this->creatingResource = false;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.users.create');
    }
}

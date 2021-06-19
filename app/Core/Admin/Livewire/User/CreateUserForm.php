<?php

namespace App\Core\Admin\Livewire\User;

use App\Core\Auth\Concerns\GetsAuthConnection;
use App\Core\Livewire\BaseCreateForm;
use Laravel\Fortify\Contracts\CreatesNewUsers;

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
        'menus' => [],
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

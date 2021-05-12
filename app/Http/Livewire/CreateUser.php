<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class CreateUser extends Component
{
    use AuthorizesRequests,
        InteractsWithBanner;

    public $creatingUser = false;

    public array $createUserForm = [
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

    public $listeners = ['openCreateDialog'];

    public function openCreateDialog()
    {
        $this->creatingUser = true;
        $this->dispatchBrowserEvent('showing-create-user-modal');
    }

    public function closeCreateDialog()
    {
        $this->creatingUser = false;
        $this->emit('closeCreateDialog');
    }

    public function createUser(UserService $users)
    {
        $this->authorize('admin.access.users');

        $this->resetErrorBag();

        Validator::make($this->createUserForm, [
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

        $users->store($this->createUserForm);
        $this->emit('closeCreateDialog');
        $this->emit('userCreated');
        $this->creatingUser = false;
    }

    public function render()
    {
        return view('admin.users.create');
    }
}

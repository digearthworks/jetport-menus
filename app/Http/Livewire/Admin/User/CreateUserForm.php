<?php

namespace App\Http\Livewire\Admin\User;

use App\Auth\Concerns\GetsAuthConnection;
use App\Http\Livewire\BaseCreateForm;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use PhpParser\Node\Expr\Throw_;

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

    public function createUser(CreatesNewUsers $users): void
    {
        $this->authorize('admin.access.users');

        $this->resetErrorBag();

        Validator::make($this->state, [
            'type' => ['string'],
            'name' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')],
            'password' => ['required'],
            'active' => ['integer'],
            'roles' => ['array'],
            'permissions' => ['array'],
            'menus' => ['array'],
            'send_confirmation_email' => ['integer'],
            'email_verified' => ['integer'],
        ])->validateWithBag('creatUserForm');

        try{
            $users->create($this->state);
        } catch(Exception $e){
            throw $e;
        }
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

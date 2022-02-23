<?php

namespace App\Turbine\Auth\Concerns;

use App\Turbine\Auth\Http\Livewire\ClearUserSessionDialog;
use App\Turbine\Auth\Http\Livewire\CreateRoleButton;
use App\Turbine\Auth\Http\Livewire\CreateRoleForm;
use App\Turbine\Auth\Http\Livewire\CreateUserButton;
use App\Turbine\Auth\Http\Livewire\CreateUserForm;
use App\Turbine\Auth\Http\Livewire\DeactivateUserDialog;
use App\Turbine\Auth\Http\Livewire\DeleteRoleDialog;
use App\Turbine\Auth\Http\Livewire\DeleteUserDialog;
use App\Turbine\Auth\Http\Livewire\EditRoleForm;
use App\Turbine\Auth\Http\Livewire\EditUserForm;
use App\Turbine\Auth\Http\Livewire\EditUserPasswordForm;
use App\Turbine\Auth\Http\Livewire\ReactivateUserDialog;
use App\Turbine\Auth\Http\Livewire\RestoreUserDialog;
use App\Turbine\Auth\Http\Livewire\RolesTable;
use App\Turbine\Auth\Http\Livewire\UsersTable;
use Livewire\Livewire;

trait RegistersAuthLivewireComponents
{
    public function registerAuthLivewire() : void
    {
        Livewire::component('turbine.auth.roles-table', RolesTable::class);
        Livewire::component('turbine.auth.create-role-form', CreateRoleForm::class);
        Livewire::component('turbine.auth.edit-role-form', EditRoleForm::class);

        Livewire::component('turbine.auth.delete-role-dialog', DeleteRoleDialog::class);

        Livewire::component('turbine.auth.create-role-button', CreateRoleButton::class);

        Livewire::component('turbine.auth.users-table', UsersTable::class);

        Livewire::component('turbine.auth.create-user-form', CreateUserForm::class);
        Livewire::component('turbine.auth.edit-user-form', EditUserForm::class);
        Livewire::component('turbine.auth.edit-user-password-form', EditUserPasswordForm::class);

        Livewire::component('turbine.auth.delete-user-dialog', DeleteUserDialog::class);
        Livewire::component('turbine.auth.restore-user-dialog', RestoreUserDialog::class);
        Livewire::component('turbine.auth.deactivate-user-dialog', DeactivateUserDialog::class);
        Livewire::component('turbine.auth.clear-user-session-dialog', ClearUserSessionDialog::class);
        Livewire::component('turbine.auth.reactivate-user-dialog', ReactivateUserDialog::class);

        Livewire::component('turbine.auth.create-user-button', CreateUserButton::class);
    }
}

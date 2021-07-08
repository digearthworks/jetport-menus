<?php

namespace Turbine\Auth\Concerns;

use Livewire;
use Turbine\Auth\Http\Livewire\ClearUserSessionDialog;
use Turbine\Auth\Http\Livewire\CreateRoleButton;
use Turbine\Auth\Http\Livewire\CreateRoleForm;
use Turbine\Auth\Http\Livewire\CreateUserButton;
use Turbine\Auth\Http\Livewire\CreateUserForm;
use Turbine\Auth\Http\Livewire\DeactivateUserDialog;
use Turbine\Auth\Http\Livewire\DeleteRoleDialog;
use Turbine\Auth\Http\Livewire\DeleteUserDialog;
use Turbine\Auth\Http\Livewire\EditRoleForm;
use Turbine\Auth\Http\Livewire\EditUserForm;
use Turbine\Auth\Http\Livewire\EditUserPasswordForm;
use Turbine\Auth\Http\Livewire\ReactivateUserDialog;
use Turbine\Auth\Http\Livewire\RestoreUserDialog;
use Turbine\Auth\Http\Livewire\RolesTable;
use Turbine\Auth\Http\Livewire\UsersTable;

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

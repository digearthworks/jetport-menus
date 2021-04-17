<?php

namespace App\Http\Livewire\Datatables;

use App\Models\User;
use Mediconesystems\LivewireDatatables\Column;

class UsersTable extends BaseTable
{
    public $model = User::class;

    public function columns()
    {
        return [
            Column::name('id')
                ->hide(),

            Column::name('type')
                ->label(__('Type'))
                ->defaultSort('asc')
                ->searchable()
                // ->filterable()
                ->view('tables.user.type'),

            Column::name('name')
                // ->filterable()
                ->searchable(),

            Column::callback(['email'], fn ($email) => $this->mailto($email))
                ->label(__('E-mail'))
                // ->filterable()
                ->searchable(),

            Column::name('email_verified_at')
                ->label(__('Verified'))
                ->searchable()
                // ->filterable()
                ->view('tables.user.verified'),

            Column::name('two_factor_secret')
                ->label(__('2FA'))
                ->searchable()
                // ->filterable()
                ->view('tables.user.2fa'),

            Column::name('roles.name')
                ->label(__('Role')),
        ];
    }
}

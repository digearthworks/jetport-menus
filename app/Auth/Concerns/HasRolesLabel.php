<?php

namespace App\Auth\Concerns;

use App\Auth\Models\Role;

trait HasRolesLabel
{
    public function getRolesLabelAttribute(): string
    {
        if ($this->roles->count() === Role::count()) {
            return 'All';
        }

        if (! $this->roles->count()) {
            return 'None';
        }

        return collect($this->getRoleNames())
            ->implode('<br/>');
    }
}

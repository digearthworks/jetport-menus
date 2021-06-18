<?php

namespace App\Core\Auth\Concerns;

use App\Core\Auth\Models\Permission;
use Illuminate\Support\Collection;

trait HasPermissionsLabel
{
    public function getPermissionDescriptions(): Collection
    {
        return $this->permissions->pluck('description');
    }

    public function getPermissionsLabelAttribute(): string
    {
        if ($this->getAllPermissions()->count() === Permission::count()) {
            return 'All';
        }

        if (! $this->permissions->count()) {
            return 'None';
        }

        return collect($this->getPermissionDescriptions())
            ->implode('<br/>');
    }
}

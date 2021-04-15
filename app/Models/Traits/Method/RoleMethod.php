<?php

namespace App\Models\Traits\Method;

use Illuminate\Support\Collection;

trait RoleMethod
{
    public function isAdmin(): bool
    {
        return $this->name === config('jetport.auth.access.role.admin');
    }

    public function getPermissionDescriptions(): Collection
    {
        return $this->permissions->pluck('description');
    }
}

<?php

namespace App\Models\Concerns\Method;

use Illuminate\Support\Collection;

trait RoleMethod
{
    public function isAdmin(): bool
    {
        return $this->name === config('template.auth.access.role.admin');
    }

    public function getPermissionDescriptions(): Collection
    {
        return $this->permissions->pluck('description');
    }
}

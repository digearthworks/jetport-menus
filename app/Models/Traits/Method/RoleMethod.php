<?php

namespace App\Models\Traits\Method;

use Illuminate\Support\Collection;

trait RoleMethod
{
    public function isAdmin(): bool
    {
        return $this->name === config('domains.auth.access.role.admin');
    }

    /**
     * @return Collection
     */
    public function getPermissionDescriptions(): Collection
    {
        return $this->permissions->pluck('description');
    }
}

<?php

namespace App\Auth\Concerns;

trait RoleMethod
{
    public function isAdmin(): bool
    {
        return $this->name === config('template.auth.access.role.admin');
    }
}

<?php

namespace App\Auth\Concerns;

use Illuminate\Support\Collection;

trait RoleMethod
{
    public function isAdmin(): bool
    {
        return $this->name === config('template.auth.access.role.admin');
    }
}

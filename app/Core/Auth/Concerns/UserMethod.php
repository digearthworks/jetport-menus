<?php

namespace App\Core\Auth\Concerns;

use App\Core\Auth\Enums\UserType;

/**
 * Trait UserMethod.
 */
trait UserMethod
{
    public function isMasterAdmin(): bool
    {
        return $this->id === 1;
    }

    public function isAdmin(): bool
    {
        return $this->type->equals(UserType::admin());
    }

    public function isUser(): bool
    {
        return $this->type->equals(UserType::user());
    }

    public function hasAllAccess(): bool
    {
        return $this->isAdmin() && $this->hasRole(config('template.auth.access.role.admin'));
    }

    /**
     * @param $type
     *
     * @return bool
     */
    public function isType($type): bool
    {
        return $this->type->equals($type);
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function isVerified(): bool
    {
        return $this->email_verified_at !== null;
    }

    public function isSocial(): bool
    {
        return $this->provider && $this->provider_id;
    }

    /**
    *  Find whether the model has active clients
    *
    * @return bool
    */
    public function hasActiveClients()
    {
        return $this->clients->where('revoked', 0)->count() > 0;
    }
}

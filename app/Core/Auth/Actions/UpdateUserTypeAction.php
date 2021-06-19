<?php

namespace App\Core\Auth\Actions;

use App\Core\Auth\Enums\UserType;
use App\Core\Auth\Models\User;

class UpdateUserTypeAction
{
    public function __invoke(User $user, $type = null)
    {
        $user->update([
            'type' => $user->isMasterAdmin() ? UserType::admin() : $type ?? $user->type,
        ]);
    }
}

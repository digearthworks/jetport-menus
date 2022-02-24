<?php

namespace App\Turbine\Auth\Actions;

use App\Turbine\Auth\Enums\UserTypeEnum;
use App\Models\User;

class UpdateUserTypeAction
{
    public function __invoke(User $user, $type = null)
    {
        $user->update([
            'type' => $user->isMasterAdmin() ? UserTypeEnum::admin() : $type ?? $user->type,
        ]);
    }
}

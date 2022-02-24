<?php

namespace App\Turbine\Auth\Actions;

use App\Models\User;
use App\Turbine\Auth\Enums\UserTypeEnum;

class UpdateUserTypeAction
{
    public function __invoke(User $user, $type = null)
    {
        $user->update([
            'type' => $user->isMasterAdmin() ? UserTypeEnum::admin() : $type ?? $user->type,
        ]);
    }
}

<?php

namespace App\Turbine\Auth\Actions;

use App\Turbine\Auth\Enums\UserTypeEnum;
use App\Turbine\Auth\Models\User;

class UpdateUserTypeAction
{
    public function __invoke(User $user, $type = null)
    {
        $user->update([
            'type' => $user->isMasterAdmin() ? UserTypeEnum::admin() : $type ?? $user->type,
        ]);
    }
}

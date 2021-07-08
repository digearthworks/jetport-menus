<?php

namespace Turbine\Auth\Actions;

use Turbine\Auth\Enums\UserTypeEnum;
use Turbine\Auth\Models\User;

class UpdateUserTypeAction
{
    public function __invoke(User $user, $type = null)
    {
        $user->update([
            'type' => $user->isMasterAdmin() ? UserTypeEnum::admin() : $type ?? $user->type,
        ]);
    }
}

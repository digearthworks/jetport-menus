<?php

namespace App\Auth\Actions;

use App\Auth\Models\User;

class UpdateUserTypeAction
{
    public function __invoke(User $user, $type = null)
    {
        $user->update([
            'type' => $user->isMasterAdmin() ? $this->model::TYPE_ADMIN : $type ?? $user->type,
        ]);
    }
}

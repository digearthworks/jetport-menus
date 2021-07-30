<?php

namespace App\Turbine\Auth\Actions;

use Illuminate\Support\Facades\Gate;
use App\Turbine\Auth\Enums\UserTypeEnum;

class BootGateProviderAction
{
    public function __invoke()
    {
        // Implicitly grant "Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user) {
            return $user->hasAllAccess();
        });

        Gate::define('is_admin', function ($user = null) {
            return $user->type === UserTypeEnum::admin();
        });
    }
}

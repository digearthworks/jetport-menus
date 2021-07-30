<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use App\Turbine\Auth\Actions\BootComponentProviderAction;
use App\Turbine\Auth\Actions\BootComposerProviderAction;
use App\Turbine\Auth\Actions\BootGateProviderAction;
use App\Turbine\Auth\Concerns\RegistersAuthLivewireComponents;
use App\Turbine\Auth\Contracts\RegistersAuthLivewire;

class AuthServiceProvider extends ServiceProvider implements RegistersAuthLivewire
{
    use RegistersAuthLivewireComponents;
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(
        BootComposerProviderAction $bootComposerProviderAction,
        BootGateProviderAction $bootGateProviderAction,
        BootComponentProviderAction $bootComponentProviderAction
    ) {
        $this->registerPolicies();

        $authViewComposer = ($bootComposerProviderAction)();

        $authGates = ($bootGateProviderAction)();

        $authComponents = ($bootComponentProviderAction)();

        Passport::routes();

        Passport::tokensCan([
            'create' => 'Create resources',
            'read' => 'Read Resources',
            'update' => 'Update Resources',
            'delete' => 'Delete Resources',
        ]);

        Passport::setDefaultScope([
            // 'create',
            'read',
            // 'update',
            // 'delete',
        ]);
    }

    public function register()
    {
        $this->registerAuthLivewire();
    }
}

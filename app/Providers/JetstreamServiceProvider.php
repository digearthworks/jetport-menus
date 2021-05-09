<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use App\Http\Livewire\ApiTokenManagerComponent;
use App\Http\Livewire\ClientManager;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\Jetstream;
use Laravel\Passport\Passport;
// use App\Http\Livewire\DeleteUserForm;
// use App\Http\Livewire\LogoutOtherBrowserSessionsForm;
// use App\Http\Livewire\NavigationDropdown;
// use App\Http\Livewire\TwoFactorAuthenticationForm;
// use App\Http\Livewire\UpdatePasswordForm;
// use App\Http\Livewire\UpdateProfileInformationForm;
use Livewire\Livewire;

class JetstreamServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->afterResolving(BladeCompiler::class, function () {
            if (config('jetstream.stack') === 'livewire' && class_exists(Livewire::class)) {
                // Livewire::component('navigation-dropdown', NavigationDropdown::class);
                // Livewire::component('profile.update-profile-information-form', UpdateProfileInformationForm::class);
                // Livewire::component('profile.update-password-form', UpdatePasswordForm::class);
                // Livewire::component('profile.two-factor-authentication-form', TwoFactorAuthenticationForm::class);
                // Livewire::component('profile.logout-other-browser-sessions-form', LogoutOtherBrowserSessionsForm::class);
                // Livewire::component('profile.delete-user-form', DeleteUserForm::class);

                if (Features::hasApiFeatures()) {
                    Livewire::component('api.api-token-manager', ApiTokenManagerComponent::class);
                    Livewire::component('api.client-manager', ClientManager::class);
                }

                // if (Features::hasTeamFeatures()) {
                //     Livewire::component('teams.create-team-form', CreateTeamForm::class);
                //     Livewire::component('teams.update-team-name-form', UpdateTeamNameForm::class);
                //     Livewire::component('teams.team-member-manager', TeamMemberManager::class);
                //     Livewire::component('teams.delete-team-form', DeleteTeamForm::class);
                // }
            }
        });
    }

    public function boot()
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions(Passport::scopeIds());
    }
}

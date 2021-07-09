<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\Jetstream;
use Laravel\Passport\Passport;
use Livewire\Livewire;
use Turbine\Auth\Actions\DeleteUser;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->afterResolving(BladeCompiler::class, function () {
            if (config('jetstream.stack') === 'livewire' && class_exists(Livewire::class)) {
                // Livewire::component('navigation-menu', NavigationMenu::class);
                // Livewire::component('profile.update-profile-information-form', UpdateProfileInformationForm::class);
                // Livewire::component('profile.update-password-form', UpdatePasswordForm::class);
                // Livewire::component('profile.two-factor-authentication-form', TwoFactorAuthenticationForm::class);
                // Livewire::component('profile.logout-other-browser-sessions-form', LogoutOtherBrowserSessionsForm::class);
                // Livewire::component('profile.delete-user-form', DeleteUserForm::class);

                if (Features::hasApiFeatures()) {
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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
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

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Turbine\Menus\Concerns\RegistersMenusLivewireComponents;
use Turbine\Menus\Contracts\RegistersMenusLivewire;
use Turbine\Pages\Concerns\RegistersPagesLivewireComponents;
use Turbine\Pages\Contracts\RegistersPagesLivewire;

class AppServiceProvider extends ServiceProvider implements RegistersMenusLivewire, RegistersPagesLivewire
{
    use RegistersMenusLivewireComponents;
    use RegistersPagesLivewireComponents;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMenusLivewire();
        $this->registerPagesLivewire();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

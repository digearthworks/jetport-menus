<?php

namespace App\Providers;

use App\Turbine\Menus\Concerns\RegistersMenusLivewireComponents;
use App\Turbine\Menus\Contracts\RegistersMenusLivewire;
use App\Turbine\Pages\Concerns\RegistersPagesLivewireComponents;
use App\Turbine\Pages\Contracts\RegistersPagesLivewire;
use Illuminate\Support\ServiceProvider;

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

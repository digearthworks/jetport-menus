<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Turbine\Menus\Concerns\RegistersMenusLivewireComponents;
use App\Turbine\Menus\Contracts\RegistersMenusLivewire;
use App\Turbine\Pages\Concerns\RegistersPagesLivewireComponents;
use App\Turbine\Pages\Contracts\RegistersPagesLivewire;

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

<?php

namespace App\MenuSystem;

use Illuminate\Support\ServiceProvider;

class MenusServiceProvider extends ServiceProvider
{
    public function register()
    {
        // $this->mergeConfigFrom(__DIR__.'/config/menus_config.php', 'menus');
    }

    public function boot()
    {
        //$this->loadMigrationsFrom(__DIR__.'/Database/migrations');
        $this->loadRoutesFrom(__DIR__.'/menus_routes.php');
        //$this->loadViewsFrom(__DIR__.'/views', 'menus');
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $app_logo = config('ui.logo');

            if (app()->environment(['testing', 'local'])) {
                $app_logo = '/stock-img/' . Storage::disk('stock-img')->files()[
                    rand(0, (count(Storage::disk('stock-img')->files()) - 1))
                ];
            }

            $view->with('app_logo', $app_logo);
        });
    }
}

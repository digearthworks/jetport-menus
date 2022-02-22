<?php

namespace App\Providers;

use App\Turbine\Pages\Http\Controllers\PageController;
use App\Turbine\Pages\Models\Page;
use Exception;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Schema;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            // For the 'Login As' functionality from the 404labfr/laravel-impersonate package
            Route::middleware('web')
                ->group(function (Router $router) {
                    $router->impersonate();
                });

            try {
                // Just check if we have DB connection! This is to avoid
                // exceptions on new projects before configuring database options
                DB::connection()->getPdo();

                if (Schema::hasTable('pages')) {
                    foreach (Page::onlyActive()->where('layout', 'layouts.blank')->get() as $page) {
                        Route::get($page->slug, [PageController::class, 'show']);
                    }
                }
            } catch (Exception $e) {
                // Be quite! Do not do or say anything!!
            }
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}

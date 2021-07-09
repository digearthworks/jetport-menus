<?php

namespace App;

use Illuminate\Foundation\Http\Kernel;

class HttpKernel extends Kernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Laravel\Jetstream\Http\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Turbine\Auth\Http\Middleware\ToBeLoggedOut::class,
            \Turbine\Auth\Http\Middleware\CheckIfActive::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        'admin' => [
            'auth',
            'is_admin',
        ],
        'adminer' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,

            // you may create customized middleware to fit your needs
            // example uses Laravel default authentication (default protection)
            \Illuminate\Auth\Middleware\Authenticate::class,
            \Turbine\Auth\Http\Middleware\AdminCheck::class,
            \Turbine\Auth\Http\Middleware\SuperAdminCheck::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class,
            // \Illuminate\Auth\Middleware\RequirePassword::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'type' => \Turbine\Auth\Http\Middleware\UserTypeCheck::class,
        'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
        'is_admin' => \Turbine\Auth\Http\Middleware\AdminCheck::class,
        'has_menu' => \Turbine\Menus\Http\Middleware\MenuCheck::class,
        'is_super_admin' => \Turbine\Auth\Http\Middleware\SuperAdminCheck::class,
    ];
}

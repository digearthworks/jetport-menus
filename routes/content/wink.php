<?php

use App\Http\Controllers\Bridge\WinkBridgeController;
use Illuminate\Support\Facades\Route;

if (config('template.cms.driver') === 'wink') {
    Route::middleware(config('wink.middleware_group'))
        ->as('wink.')
        ->domain(config('wink.domain'))
        ->prefix(config('wink.path'))
        ->group(function () {
            Route::get('huh', function () {
            });
            Route::get('/login', [WinkBridgeController::class, 'showLoginForm'])->name('auth.login');
            Route::post('/login', [WinkBridgeController::class, 'login'])->name('auth.attempt');
            // Logout Route...
            Route::get('/logout', [WinkBridgeController::class, 'logout'])->name('logout');
        });
}

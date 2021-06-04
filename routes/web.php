<?php

use App\Http\Controllers\Bridge\WinkBridgeController;
use App\Http\Controllers\LocaleController;

use Illuminate\Support\Facades\Route;

// Switch between the included languages
Route::get('lang/{lang}', [LocaleController::class, 'change'])->name('locale.change');

Route::view('/', 'welcome')->name('index');

Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

/*
 * Admin Routes
 *
 * These routes can only be accessed by users with type `admin`
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    includeRouteFiles(__DIR__.'/admin/');
});

/*
 * Menu Routes
 */
Route::group(['prefix' => 'menus', 'as' => 'menus.', 'middleware' => 'auth'], function () {
    includeRouteFiles(__DIR__.'/menus/');
});

/*
 *  Local Iframe Routes
 */
Route::group([
    'prefix' => config('menus.url_segments.internal_iframe_prefix'),
    'as' => config('menus.url_segments.internal_iframe_prefix').'.',
    'middleware' => 'auth'
], function () {
    includeRouteFiles(__DIR__.'/iframes/');
});

/*
 *  External Iframe Routes
 */
Route::group([
    'prefix' => config('menus.url_segments.external_iframe_prefix'),
    'as' => config('menus.url_segments.external_iframe_prefix').'.',
    'middleware' => 'auth'
], function () {
    includeRouteFiles(__DIR__.'/extras/');
});


if (config('template.cms.cms')) {
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
}

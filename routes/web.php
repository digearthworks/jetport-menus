<?php

use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;

// Switch between the included languages
Route::get('lang/{lang}', [LocaleController::class, 'change'])->name('locale.change');

Route::view('/', 'welcome')->name('index');

Route::view('/dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
 * Admin Routes
 *
 * These routes can only be accessed by users with type `admin`
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    includeRouteFiles(__DIR__ . '/admin/');
});

/*
 * Menu Routes
 */
Route::group(['prefix' => 'menus', 'as' => 'menus.', 'middleware' => 'auth'], function () {
    includeRouteFiles(__DIR__ . '/menus/');
});

/*
 *  Local Iframe Routes
 */
Route::group([
    'prefix' => config('menus.url_segments.internal_iframe_prefix'),
    'as' => config('menus.url_segments.internal_iframe_prefix') . '.',
    'middleware' => 'auth'
], function () {
    includeRouteFiles(__DIR__ . '/iframes/');
});

/*
 *  External Iframe Routes
 */
Route::group([
    'prefix' => config('menus.url_segments.external_iframe_prefix'),
    'as' => config('menus.url_segments.external_iframe_prefix') . '.',
    'middleware' => 'auth'
], function () {
    includeRouteFiles(__DIR__ . '/extras/');
});


if (config('template.cms.cms')) {

    /*
    *  Managed Content Routes
    */
    Route::group([], function () {
        includeRouteFiles(__DIR__ . '/content/');
    });
}

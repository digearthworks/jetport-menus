<?php

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

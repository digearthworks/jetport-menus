<?php

use App\Turbine\Menus\Http\Controllers\MenuController;
use App\Turbine\Pages\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', WelcomeController::class)->name('index');

Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

/*
 * Admin Routes
 *
 * These routes can only be accessed by users with type `admin`
 */
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    includeRouteFiles(__DIR__.'/admin/');
});

/*
 *  Menu Routes
 */
Route::prefix(config('turbine.menus.route_prefix'))->name('menus.')->group(function () {
    includeRouteFiles(__DIR__.'/menus/');
});

/*
 *  Page Routes
 */
Route::prefix(config('turbine.pages.route_prefix'))->name('pages.')->group(function () {
    includeRouteFiles(__DIR__.'/pages/');
});

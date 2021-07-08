<?php

use Illuminate\Support\Facades\Route;
use Turbine\Menus\Http\Controllers\MenuController;

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

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


/*
 * Admin Routes
 *
 * These routes can only be accessed by users with type `admin`
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    includeRouteFiles(__DIR__ . '/admin/');
});

/*
 *  Menu Routes
 */
Route::group([
    'prefix' => config('turbine.menus.route_prefix'),
    'as' => 'menus.',
], function () {
    includeRouteFiles(__DIR__ . '/menus/');
});

/*
 *  Page Routes
 */
Route::group([
    'prefix' => config('turbine.pages.route_prefix'),
    'as' => 'pages.',
], function () {
    includeRouteFiles(__DIR__ . '/pages/');
});

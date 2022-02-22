<?php

use App\Turbine\Menus\Http\Controllers\Admin\AdminMenuController;
use Illuminate\Support\Facades\Route;

Route::get('/menus', AdminMenuController::class)
    // ->middleware('password.confirm')
    ->middleware('can:admin.access.menus')
    ->name('menus');

Route::view('/menus/deleted', 'admin.menus.deleted')
    // ->middleware('password.confirm')
    ->name('menus.deleted');

Route::view('/menus/deactivated', 'admin.menus.deactivated')
    // ->middleware('password.confirm')
    ->name('menus.deactivated');

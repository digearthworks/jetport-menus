<?php

use Illuminate\Support\Facades\Route;
use Turbine\Menus\Http\Controllers\Admin\AdminMenuController;

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

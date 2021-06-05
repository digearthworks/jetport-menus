<?php

use Illuminate\Support\Facades\Route;

Route::view('/auth/menus', 'admin.menus.index')
    // ->middleware('password.confirm')
    ->middleware('can:admin.access.menus')
    ->name('menus');

Route::view('/auth/menus/deleted', 'admin.menus.deleted')
    // ->middleware('password.confirm')
    ->name('menus.deleted');

Route::view('/auth/menus/deactivated', 'admin.menus.deactivated')
    // ->middleware('password.confirm')
    ->name('menus.deactivated');

<?php

use Illuminate\Support\Facades\Route;

Route::view('/auth/menus', 'admin.menus.index')
    ->middleware('password.confirm')
    ->middleware('can:admin.access.menus')
    ->name('menus');

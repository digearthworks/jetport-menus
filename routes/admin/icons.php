<?php

use Illuminate\Support\Facades\Route;

Route::view('/auth/icons', 'admin.icons.index')
    // ->middleware('password.confirm')
    ->middleware('can:admin.access.menus')
    ->name('icons');

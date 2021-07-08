<?php

use Illuminate\Support\Facades\Route;

Route::view('/users', 'admin.users.index')
    ->middleware('password.confirm')
    ->name('users');

Route::view('/users/deleted', 'admin.users.deleted')
    ->middleware('password.confirm')
    ->middleware('can:admin.access.users.deleted')
    ->name('users.deleted');

Route::view('/users/deactivated', 'admin.users.deactivated')
    ->middleware('password.confirm')
    ->middleware('can:admin.access.users.deactivated')
    ->name('users.deactivated');

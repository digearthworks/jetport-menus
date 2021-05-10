<?php

use Illuminate\Support\Facades\Route;

Route::view('/auth/users', 'admin.users.index')
    ->middleware('password.confirm')
    ->middleware('can:admin.access.users')
    ->name('users');

Route::view('/auth/users/deleted', 'admin.users.deleted')
    ->middleware('password.confirm')
    ->middleware('can:admin.access.users.deleted')
    ->name('users.deleted');

Route::view('/auth/users/deactivated', 'admin.users.deactivated')
    ->middleware('password.confirm')
    ->middleware('can:admin.access.users.deactivated')
    ->name('users.deactivated');

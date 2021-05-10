<?php

use Illuminate\Support\Facades\Route;

Route::view('/auth/roles', 'admin.roles.index')
    ->middleware('password.confirm')
    ->middleware('can:admin.access.users')
    ->name('roles');

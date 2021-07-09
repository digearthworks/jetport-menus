<?php

use Illuminate\Support\Facades\Route;

Route::view('/roles', 'admin.roles.index')
    // ->middleware('password.confirm')
    ->middleware('can:admin.access.users')
    ->name('roles');

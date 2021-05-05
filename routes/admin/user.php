<?php

use Illuminate\Support\Facades\Route;

Route::view('/auth/users', 'admin.user.index')
    ->middleware('password.confirm');

Route::view('/auth/users/deleted', 'admin.user.deleted')
    ->middleware('password.confirm');

Route::view('/auth/users/deacivated', 'admin.user.deactivated')
    ->middleware('password.confirm');

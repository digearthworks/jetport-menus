<?php

use Illuminate\Support\Facades\Route;

Route::view('/auth/users', 'admin.user.index')
    ->middleware('password.confirm')->name('users');

Route::view('/auth/users/deleted', 'admin.user.deleted')
    ->middleware('password.confirm')->name('users.deleted');

Route::view('/auth/users/deactivated', 'admin.user.deactivated')
    ->middleware('password.confirm')->name('users.deactivated');

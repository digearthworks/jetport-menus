<?php

use Illuminate\Support\Facades\Route;

Route::view('/auth/user', 'admin.user.index')
    ->middleware('password.confirm');

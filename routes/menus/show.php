<?php

use Illuminate\Support\Facades\Route;
use Turbine\Menus\Http\Controllers\MenuController;

Route::get('{menuItem}', [MenuController::class, 'show'])
    ->name('show')
    ->middleware('auth');

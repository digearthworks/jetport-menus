<?php

use App\Turbine\Menus\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('{menuItem}', [MenuController::class, 'show'])
    ->name('show')
    ->middleware('auth');

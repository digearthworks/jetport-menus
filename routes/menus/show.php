<?php

use App\Menus\Controllers\MenuController;

Route::get('{menu:id}', [MenuController::class, 'show'])
    ->middleware('auth');

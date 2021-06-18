<?php

use App\Core\Menus\Controllers\MenuController;

Route::get('{menu:id}', [MenuController::class, 'show'])
    ->middleware('auth');

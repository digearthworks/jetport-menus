<?php

use App\Http\Controllers\MenuController;

Route::get('{menu:id}', [MenuController::class, 'show'])
    ->middleware('auth');

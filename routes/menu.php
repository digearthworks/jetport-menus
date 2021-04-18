<?php

use App\Domains\Auth\Http\Controllers\Frontend\Menu\MenuController;

Route::get('/menus/manage', [MenuController::class, 'manage'])
    ->middleware('auth')
    ->middleware('can:any_menus_permission');

Route::get('/menus/index', [MenuController::class, 'index'])
    ->middleware('auth')
    ->middleware('can:admin.access.menus.*');

Route::get('/menus/{menu}', [MenuController::class, 'show'])
    ->middleware('auth');

Route::get('/menus/create', [MenuController::class, 'create'])
    ->middleware('can:admin.access.menus.create');

Route::get('/menus/edit/{menu}', [MenuController::class, 'edit'])
    ->middleware('can:admin.access.menus.edit');

Route::post('/menus', [MenuController::class, 'store'])
    ->middleware('can:admin.access.menus.create');

Route::patch('/menus/{menu}', [MenuController::class, 'update'])
    ->middleware('can:admin.access.menus.edit');

Route::put('/menus', [MenuController::class, 'update'])
    ->middleware('can:admin.access.menus.edit');

Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])
    ->middleware('can:admin.access.menus.delete');

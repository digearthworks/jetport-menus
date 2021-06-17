<?php

use Illuminate\Support\Facades\Route;

Route::view('/site/pages', 'admin.pages.index')
    ->name('pages');

Route::view('/site/pages/deleted', 'admin.pages.deleted')
    ->middleware('password.confirm')
    ->name('pages.deleted');

Route::view('/site/pages/deactivated', 'admin.pages.deactivated')
    ->middleware('password.confirm')
    ->name('pages.deactivated');

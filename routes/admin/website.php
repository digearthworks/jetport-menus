<?php

use Illuminate\Support\Facades\Route;

Route::view('/site/pages', 'admin.site.pages.index')
    ->name('pages');

Route::view('/site/pages/deleted', 'admin.site.pages.deleted')
    ->middleware('password.confirm')
    ->name('pages.deleted');

Route::view('/site/pages/deactivated', 'admin.site.pages.deactivated')
    ->middleware('password.confirm')
    ->name('pages.deactivated');

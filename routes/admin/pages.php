<?php

use App\Turbine\Pages\Http\Controllers\CkeditorController;
use App\Turbine\Pages\Http\Controllers\PageController;
use App\Turbine\Pages\Http\Controllers\PageTemplateController;
use Illuminate\Support\Facades\Route;

Route::get('/pages/create', [PageController::class, 'create'])
    ->name('pages.create');

Route::get('/pages/edit/{page}', [PageController::class, 'edit'])
    ->name('pages.edit');

Route::view('/pages', 'admin.pages.index')
    ->name('pages');

Route::view('/pages/deleted', 'admin.pages.deleted')
    ->middleware('password.confirm')
    ->name('pages.deleted');

Route::view('/pages/deactivated', 'admin.pages.deactivated')
    ->middleware('password.confirm')
    ->name('pages.deactivated');

Route::view('/pages/templates', 'admin.pages.templates')
    ->name('pages.templates');

Route::get('/pages/templates/edit/{template}', [PageTemplateController::class, 'edit'])
    ->name('pages.templates.edit');

Route::get('/pages/templates/create', [PageTemplateController::class, 'create'])
    ->name('pages.templates.create');

Route::post('/uploads', CkeditorController::class)->name('ckeditor.upload');

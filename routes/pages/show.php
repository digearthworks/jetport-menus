<?php

use Illuminate\Support\Facades\Route;
use Turbine\Pages\Http\Livewire\Webpage;

Route::get('{page:slug}', Webpage::class)
    ->name('show');

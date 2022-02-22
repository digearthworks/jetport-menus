<?php

use App\Turbine\Pages\Http\Livewire\Webpage;
use Illuminate\Support\Facades\Route;

Route::get('{page:slug}', Webpage::class)
    ->name('show');

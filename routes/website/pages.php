<?php

use App\Http\Livewire\Webpage;
use Illuminate\Support\Facades\Route;

if (config('template.website.managed')) {
    Route::get('/pages/{page:slug}', Webpage::class);
}

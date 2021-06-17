<?php

use App\Http\Livewire\Webpage;
use Illuminate\Support\Facades\Route;

Route::get('/pages/{page:slug}', Webpage::class);

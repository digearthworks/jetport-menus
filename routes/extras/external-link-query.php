<?php

use App\Http\Controllers\Iframe\ExternalIframeController;
use Illuminate\Support\Facades\Route;

Route::get('', ExternalIframeController::class);

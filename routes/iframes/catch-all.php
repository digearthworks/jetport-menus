<?php

use App\Http\Controllers\Iframe\InternalIframeController;
use Illuminate\Support\Facades\Route;

Route::any('/{path}', InternalIframeController::class)->where('path', '(.*)');

<?php

use App\Iframes\Controllers\ExternalIframeController;
use Illuminate\Support\Facades\Route;

Route::get('', ExternalIframeController::class);

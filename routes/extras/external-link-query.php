<?php

use App\Core\Iframes\Controllers\ExternalIframeController;
use Illuminate\Support\Facades\Route;

Route::get('', ExternalIframeController::class);

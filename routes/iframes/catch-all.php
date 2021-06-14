<?php

use App\Iframes\Controllers\InternalIframeController;
use Illuminate\Support\Facades\Route;

Route::any('/{path}', InternalIframeController::class)->where('path', '(.*)');

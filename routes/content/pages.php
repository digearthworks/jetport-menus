<?php

use Illuminate\Support\Facades\Route;

$driver = config('template.cms.drivers.' . config('template.cms.driver'));

Route::get('/pages/{page:slug}', $driver['webpage_handler']);

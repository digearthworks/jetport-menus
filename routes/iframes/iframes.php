<?php

use Illuminate\Support\Facades\Route;

Route::any('/{path}', function ($path = null) {

    $query_string = '';


    $uri = explode('?', $_SERVER['REQUEST_URI']);

    if (count($uri) > 1) {
        $query_string = $uri[1];
    }

    parse_str($query_string, $_GET);

    return view('iframes.index', [
        'frame' => $path,
        '$_GET' => $query_string
    ]);

    abort('404');
})->where('path', '(.*)');

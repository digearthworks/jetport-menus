<?php

use Illuminate\Support\Facades\Route;

Route::any('/{param1}/{param2?}', function ($param1, $param2 = null) {
    $query_string = '';
    $q = explode('?', $_SERVER['REQUEST_URI']);
    if (count($q) > 1) {
        $query_string = $q[1];
    }
    parse_str($query_string, $_GET);
    return view('iframes.index', [
        'frame' => $param1 . '/' . $param2,
        '$_GET' => $query_string
    ]);
    abort('404');
});

// three deep routes
Route::any('/{param1}/{param2}/{param3?}', function ($param1, $param2, $param3 = null) {
    $query_string = '';
    $q = explode('?', $_SERVER['REQUEST_URI']);
    if (count($q) > 1) {
        $query_string = $q[1];
    }
    parse_str($query_string, $_GET);
    return view('iframes.index', [
        'frame' => $param1 . '/' . $param2 . '/' . $param3,
        '$_GET' => $query_string
    ]);
    abort('404');
});

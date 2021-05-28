<?php

use Illuminate\Support\Facades\Route;

Route::get('', function () {
    if (request()->has(str_replace(['?', '='], '', config('menus.url_segments.external_link_query')))) {
        $frame = request(str_replace(['?', '='], '', config('menus.url_segments.external_link_query')));
        return view('iframes.extras', ['frame' => $frame]);
    }
    abort('404');
});

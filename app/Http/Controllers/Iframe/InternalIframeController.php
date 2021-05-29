<?php

namespace App\Http\Controllers\Iframe;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class InternalIframeController extends Controller
{
    public function __invoke(string $path): View
    {
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
    }
}

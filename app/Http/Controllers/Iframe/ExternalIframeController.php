<?php

namespace App\Http\Controllers\Iframe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExternalIframeController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->has(str_replace(['?', '='], '', config('menus.url_segments.external_link_query')))) {
            $frame = $request->{str_replace(['?', '='], '', config('menus.url_segments.external_link_query'))};
            return view('iframes.extras', ['frame' => $frame]);
        }
        abort('404');
    }
}

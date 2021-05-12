<?php

return [

    'url_segments' => [

        'internal_iframe_prefix' => env('INTERNAL_IFRAME_PREFIX', 'iframes'),

        'external_iframe_prefix' =>  env('EXTERNAL_IFRAME_PREFIX', 'extras'),

        'disabled_link_prefix' => '#disabled_link#',

        'external_link_extension' => '?externallink=',
    ],
];

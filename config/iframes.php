<?php

return [

    'theme' => 'jetstream',

    'middleware' => [
        'web',
        'auth',
    ],

    /**
     * The Route prefix under which views should be loaded in an iframe.
     * This can be useful when you want to keep the appearance of the app
     * layout but the view contains css or javascript which is incompatible,
     * such as when using a package or some legacy views.
     */
    'internal_iframe_prefix' => env('INTERNAL_IFRAME_PREFIX', 'iframes'),

    /**
     * The Route prefix under which to load external iframes,
     * such as from subdomains, static sites, or services
     * running on another backend platform or framework
     */
    'external_iframe_prefix' =>  env('EXTERNAL_IFRAME_PREFIX', 'extras'),

    /**
     * The key in the query string which will
     * be used to load external sites inside
     * an iframe.
     */
    'external_link_key' => env('EXTERNAL_LINK_KEY', '?external_link='),

];

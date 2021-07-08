<?php

return [

    /**
     * All of the values listed here will be trimmed from
     * dynamic menu links, to prevent them being applied twice.
     */

    'pages_prefix' => '/pages/',

    'legacies' => 'legacy',

    /**
     * The Route prefix under which views should be loaded in an iframe.
     * This can be useful when you want to keep the appearance of the
     * but the view contains css or javascript which is incompatible.
     */
    'internal_iframe_prefix' => env('INTERNAL_IFRAME_PREFIX', 'iframes'),

    /**
     * The Route prefix under which to load external iframes,
     * such as from subdomains, static sites, or services
     * running on another backend platform or framework
     */
    'external_iframe_prefix' => env('EXTERNAL_IFRAME_PREFIX', 'extras'),

    /**
     * The key in the query string which will
     * be used to load external sites inside
     * an iframe.
     */
    'external_link_key' => env('EXTERNAL_LINK_KEY', '?external_link='),

];

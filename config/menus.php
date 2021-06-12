<?php

return [

    /**
     * You may change these for prettier urls.
     * However it is not recommended unless
     * you know what you are doing.
     */
    'url_segments' => [

        'pages_prefix' => '/pages/',

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
        'external_iframe_prefix' =>  env('EXTERNAL_IFRAME_PREFIX', 'extras'),

        /**
         * When menus or items are deactivated their links are given
         * this prefix as a failsafe to ensure the url is not
         * opened by mistake. Reactivating the item will
         * remove the prefix. Reacivating a menu will
         * remove the prefix from all of its items.
         */
        'disabled_link_prefix' => '#disabled_link#',

        /**
         * The key in the query string which will
         * be used to load external sites inside
         * an iframe.
         */
        'external_link_query' => '?external_link=',
    ],

    /**
    * Whether to allow manual entry of value for "sort" field
    * in the menu edit and create forms.
    */
    'allow_manual_sort' => true,
];

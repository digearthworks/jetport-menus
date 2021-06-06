<?php

return [

    'cms' => env('USE_TEMPLATE_CMS', true),
    'driver' => env('TEMPLATE_CMS_DRIVER', 'wink'),
    'page_layout' =>  env('TEMPLATE_CMS_PAGE_LAYOUT', 'layouts.guest'),
    'page_view' =>  env('TEMPLATE_CMS_PAGE_VIEW', 'webpage'),

    'drivers' => [
        'wink' => [
            'pages_model' => \Wink\WinkPage::class,
            'posts_model' => \Wink\WinkPost::class,
            'webpage_handler' => \App\Http\Livewire\WinkWebpage::class,
            'query' => [
                'navtop' => [
                    'key' => 'meta->meta_description',
                    'value' => 'navtop',
                ],
                'welcome' => [
                    'key' => 'meta->meta_description',
                    'value' => 'welcome',
                ],
            ],
        ],
    ],
];

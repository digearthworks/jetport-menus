<?php

return [

    'cms' => env('USE_TEMPLATE_CMS', true),
    'driver' => env('TEMPLATE_CMS_DRIVER', 'wink'),
    'welcome_layout' =>  env('TEMPLATE_CMS_WELCOME_LAYOUT', 'layouts.welcome'),
    'welcome_template' =>  env('TEMPLATE_CMS_WELCOME_LAYOUT', 'welcome'),
    'page_layout' =>  env('TEMPLATE_CMS_PAGES_LAYOUT', 'layouts.guest'),

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

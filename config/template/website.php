<?php

return [

    'managed' => env('MANAGED_WEBSITE', true),
    'page_layout' =>  env('WEBPAGE_LAYOUT', 'layouts.guest'),
    'page_view' =>  env('WEBPAGE_VIEW', 'webpage'),

    'driver' => env('WEBSITE_DRIVER', 'site'),

    'drivers' => [
        'site' => [
            'pages_model' => \App\SitePage::class,
            'page_handler' => \App\Http\Livewire\SitePage::class,
        ],
    ],
];

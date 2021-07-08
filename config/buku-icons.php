<?php

return [
    'route_prefix' => '/blade-icons',

    'middleware' => [
        'web',
    ],

    'db_connection' => env('DB_CONNECTION', 'mysql'),
];

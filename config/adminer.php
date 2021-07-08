<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Auto Login
    |--------------------------------------------------------------------------
    |
    | Enable autologin to database
    |
    | ATTENTION: Please only enable autologin with authenticated protection
    |
    */
    'autologin' => env('ALLOW_ADMINER_AUTOLOGIN', false),

    /*
    |--------------------------------------------------------------------------
    | Route Prefix
    |--------------------------------------------------------------------------
    |
    | You may customize route prefix. (default: 'adminer')
    |
    */
    'route_prefix' => 'adminer',
];
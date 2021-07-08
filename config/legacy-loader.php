<?php

return [
    'route_prefix' => env('LEGACY_ROUTE_PREFIX', 'legacy'),
    /**
     * Path to legacy php scripts
     * relative to base_path()
     */
    'file_path' => env('LEGACY_FILE_PATH', 'resources/legacy'),
    /**
     * If your legacy app has its own
     * authentication you will need
     * to publish config and add
     * your own middleware.
     */
    'middleware' => [
        'web',
        // 'auth',
    ],
];

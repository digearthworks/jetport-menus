<?php

return [

    'database_connection' => env('AUTH_DB_CONNECTION', 'mysql'),
    'default_webmaster_name' => env('DEFAULT_SUPER_ADMIN_NAME', 'Super Admin'),
    'default_webmaster_email' => env('DEFAULT_SUPER_ADMIN_EMAIL', 'admin@admin.com'),
    'default_webmaster_password' => env('DEFAULT_SUPER_ADMIN_PASSWORD', '$2y$10$w3lz8ysxcYAwN8TECDdcp.6.QHPsmTNkOSajMOyFIv3xprID94Lre'),

    'bookmarks_enabled' => env('ENABLE_BOOKMARKS', false),

    'check_permissions_on_menu_assignment' => env('CHECK_PERMISSIONS_ON_MENU_ASSIGNMENT', false),

    'default_site_owner_name' => env('DEFAULT_OWNER_NAME', 'Owner'),
    'default_site_owner_email' => env('DEFAULT_OWNER_EMAIL', 'owner@admin.com'),
    'default_site_owner_password' => env('DEFAULT_OWNER_PASSWORD', '$2y$10$w3lz8ysxcYAwN8TECDdcp.6.QHPsmTNkOSajMOyFIv3xprID94Lre'), // Hash::make('secret')

    'default_auditor_name' => env('DEFAULT_AUDITOR_NAME', 'Auditor'),
    'default_auditor_email' => env('DEFAULT_AUDITOR_EMAIL', 'auditor@admin.com'),
    'default_auditor_password' => env('DEFAULT_AUDITOR_PASSWORD', '$2y$10$w3lz8ysxcYAwN8TECDdcp.6.QHPsmTNkOSajMOyFIv3xprID94Lre'), // Hash::make('secret')

    'default_officer_name' => env('DEFAULT_OFFICER_NAME', 'Client'),
    'default_officer_email' => env('DEFAULT_OFFICER_EMAIL', 'client@example.com'),
    'default_officer_password' => env('DEFAULT_OFFICER_PASSWORD', '$2y$10$w3lz8ysxcYAwN8TECDdcp.6.QHPsmTNkOSajMOyFIv3xprID94Lre'), // Hash::make('secret')

    'default_supervisor_name' => env('DEFAULT_SUPERVISOR_NAME', 'Supervisor'),
    'default_supervisor_email' => env('DEFAULT_SUPERVISOR_EMAIL', 'supervisor@example.com'),
    'default_supervisor_password' => env('DEFAULT_SUPERVISOR_PASSWORD', '$2y$10$w3lz8ysxcYAwN8TECDdcp.6.QHPsmTNkOSajMOyFIv3xprID94Lre'), // Hash::make('secret')
    'access' => [

        'user' => [

            /*
             * Whether or not the register route and view are active
             */
            'registration' => env('ENABLE_REGISTRATION', true),

            /*
             * When active, a user can only have one session active at a time
             * That is all other sessions for that user will be deleted when they log in
             * (They can only be logged into one place at a time, all others will be logged out)
             * AuthenticateSession middleware must be enabled
             */
            'single_login' => env('SINGLE_LOGIN', false),
        ],

        'role' => [

            /*
             * The name of the administrator role
             * Should be Administrator by design and unable to change from the backend
             * It is not recommended to change
             */
            'admin' => 'Administrator',
        ],
    ],
];

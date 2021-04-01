<?php

return [

    'database_connection' => env('AUTH_DB_CONNECTION'),
    'default_webmaster_name' => env('DEFAULT_SUPER_ADMIN_NAME', 'Super Admin'),
    'default_webmaster_email' => env('DEFAULT_SUPER_ADMIN_EMAIL', 'admin@admin.com'),
    'default_webmaster_password' => env('DEFAULT_SUPER_ADMIN_PASSWORD', 'secret'),

    'bookmarks_enabled' => env('ENABLE_BOOKMARKS', false),

    'check_permissions_on_menu_assignment' => env('CHECK_PERMISSIONS_ON_MENU_ASSIGNMENT', false),

    'default_site_owner_name' => env('DEFAULT_OWNER_NAME', 'Owner'),
    'default_site_owner_email' => env('DEFAULT_OWNER_EMAIL', 'owner@admin.com'),
    'default_site_owner_password' => env('DEFAULT_OWNER_PASSWORD', 'secret'),

    'default_auditor_name' => env('DEFAULT_AUDITOR_NAME', 'Auditor'),
    'default_auditor_email' => env('DEFAULT_AUDITOR_EMAIL', 'auditor@admin.com'),
    'default_auditor_password' => env('DEFAULT_AUDITOR_PASSWORD', 'secret'),

    'default_officer_name' => env('DEFAULT_OFFICER_NAME', 'Client'),
    'default_officer_email' => env('DEFAULT_OFFICER_EMAIL', 'client@example.com'),
    'default_officer_password' => env('DEFAULT_OFFICER_PASSWORD', 'secret'),

    'default_supervisor_name' => env('DEFAULT_SUPERVISOR_NAME', 'Supervisor'),
    'default_supervisor_email' => env('DEFAULT_SUPERVISOR_EMAIL', 'supervisor@example.com'),
    'default_supervisor_password' => env('DEFAULT_SUPERVISOR_PASSWORD', 'secret'),
];

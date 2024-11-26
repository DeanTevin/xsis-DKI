<?php

return [
    /*
    |--------------------------------------------------------------------------
    | AppSection Section Authorization Container
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Admin Role
    |--------------------------------------------------------------------------
    |
    | This role is used across the app as the main authority e.g. super admin role
    |
    */

    'admin_role' => env('ADMIN_ROLE', 'admin'),

    'admin_account' => [
        'username' => 'superadmin',
        'email' => 'admin@admin.com',
        'password' => 'AdminPwd123!',
    ],

    /*
    |--------------------------------------------------------------------------
    | Roles
    |--------------------------------------------------------------------------
    |
    | Default roles
    |
    */
    'customer_service_role' => [
        'name' => 'customer-service',
        'description' => 'Customer Service: Onboarding',
        'displayName' => 'Customer Service',
        'default_account' => [
            'username' => 'CsDefault',
            'email' => 'CS@test.com',
            'password' => 'CsDefPwd123!',
        ],
    ],

    'supervisor_role' => [
        'name' => 'supervisor',
        'description' => 'Supervisor: Customer Service',
        'displayName' => 'Supervisor',
        'default_account' => [
            'username' => 'SpvDefault',
            'email' => 'SPV@test.com',
            'password' => 'SpvDefPwd123!',
        ],
    ],

];

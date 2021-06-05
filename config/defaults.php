<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

return [
    /*
     * Default User Related Settings and Details...
     */
    'users' => [
        'credentials' => [
            'name' => 'Administrator',
            'username' => 'administrator',
            'email' => 'admin@blaze.test',
            'phone' => '0112345678',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'email_verified_at' => Carbon::now(),
            'remember_token' => Str::random(10),
            'settings' => [
                'notifications' => ['mail', 'database', 'sms'],
            ],
            'address' => [
                'line1' => '4431 Birch Street',
                'city' => 'Greenwood',
                'state' => 'Indiana',
                'country' => 'United States',
                'postal_code' => '46142',
            ],
            'locked' => false,
            'owner' => true,
            'profile_photo_path' => null,
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
        ],

        'settings' => [
            'notifications' => ['mail', 'database', 'sms'],
        ],

        'admin_role' => $adminRole = [
            'name' => 'Administrator',
            'slug' => 'administrator',
            'description' => 'An administrator can do anything.',
        ],

        'roles' => [
            array_merge($adminRole, ['permissions' => ['*']]),

            [
                'name' => 'Staff',
                'slug' => 'staff',
                'description' => 'A staff can only update details.',
                'permissions' => ['update'],
            ],
        ],
    ],

    /*
     * Default API Related Details...
     */
    'api' => [
        'permissions' => [
            'create',
            'read',
            'update',
            'delete',
        ],
    ],
];

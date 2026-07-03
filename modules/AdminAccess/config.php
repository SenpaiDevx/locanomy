<?php

return [
    'name' => 'User',
    'domain' => 'user',
    'prefix' => 'user',
    'auth' => [
        'guard' => 'web',
        'passwords' => 'users',
        'verification' => true,
        'password_timeout' => 10800,
        'rate_limiting' => [
            'login' => '6,1', // 6 attempts per minute
            'verification' => '6,1',
            'password_reset' => '6,1',
        ],
    ],
    'user' => [
        'login' => [
            'max_attempts' => env('LOGIN_MAX_ATTEMPTS', 5),
            'decay_seconds' => env('LOGIN_DECAY_SECONDS', 300), // 5 minutes
        ],
    ],

    'ulid' => [
        'prefix' => 'usr_',
        'alphabet' => '0123456789abcdefghjkmnpqrstvwxyz',
    ],

    'roles' => [
        'admin' => 'admin',
        'manager' => 'manager',
        'user' => 'user',
    ],

    'permissions' => [
        'user.view' => 'View users',
        'user.create' => 'Create users',
        'user.update' => 'Update users',
        'user.delete' => 'Delete users',
        'profile.view' => 'View profile',
        'profile.update' => 'Update profile',
    ],
];
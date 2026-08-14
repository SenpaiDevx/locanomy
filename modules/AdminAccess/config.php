<?php

return [
    'lockout' => [
        'max_attempts' => env('ADMIN_LOGIN_MAX_ATTEMPTS', 5),
        'lockout_minutes' => env('ADMIN_LOGIN_LOCKOUT_MINUTES', 15),
    ],

    'password' => [
        'min_length' => env('ADMIN_PASSWORD_MIN_LENGTH', 12),
        'history_limit' => env('ADMIN_PASSWORD_HISTORY_LIMIT', 10),
        'reset_token_ttl_minutes' => env('ADMIN_RESET_TOKEN_TTL_MINUTES', 60),
    ],

    'registration' => [
        // When true, AuthenticateAdminAction refuses to establish a
        // session for an account whose email was never verified — see
        // Domain\Exceptions\EmailNotVerifiedException. Flip to false for
        // environments that create admins by trusted means only (e.g.
        // a seeder / console command) and don't need the extra gate.
        'require_email_verification' => env('ADMIN_REQUIRE_EMAIL_VERIFICATION', true),
        'verification_token_ttl_minutes' => env('ADMIN_VERIFICATION_TOKEN_TTL_MINUTES', 1440),
    ],

    'remember_me' => [
        'duration_days' => env('ADMIN_REMEMBER_ME_DAYS', 30),
    ],

    'roles' => [
        // Names as stored in spatie/laravel-permission's `roles` table
        // (guard_name 'admin' — see AdminModel::$guard_name). Referenced
        // by name rather than an enum/constant because Spatie roles are
        // inherently free-text, database-driven records, not a fixed set
        // the Domain layer can enumerate — see RoleManagerInterface's
        // docblock.
        'super_admin' => env('ADMIN_SUPER_ADMIN_ROLE', 'super-admin'),
        'default' => env('ADMIN_DEFAULT_ROLE', 'admin'),
    ],

    'setup' => [
        // Where the setup wizard sends the newly-created super-admin
        // after auto-login. Point this at your actual SPA/dashboard
        // entry route — the default is deliberately just "/" since this
        // module has no opinion on what your dashboard's URL is.
        'redirect_route' => env('ADMIN_SETUP_REDIRECT_ROUTE', '/'),
    ],

    // Named, per-route rate limits, registered via RateLimiter::for() in
    // AdminAccessServiceProvider::boot() rather than hardcoded inline as
    // `throttle:6,1` on each route. A named limiter is independently
    // testable (RateLimiter::for() can be asserted against directly) and
    // self-documents intent at the route definition (`throttle:admin-login`
    // reads better than `throttle:6,1`, which says nothing about *why*
    // it's 6). 'login' also covers verify-email/reset-password/token
    // issuance — those don't fan out an email per request the way
    // 'password_reset' (forgot-password) does, so they don't need their
    // own stricter limit.
    'rate_limits' => [
        'login' => [
            'max_attempts' => env('ADMIN_LOGIN_RATE_LIMIT', 6),
            'decay_minutes' => 1,
        ],
        'password_reset' => [
            'max_attempts' => env('ADMIN_PASSWORD_RESET_RATE_LIMIT', 3),
            'decay_minutes' => 1,
        ],
        'setup' => [
            'max_attempts' => env('ADMIN_SETUP_RATE_LIMIT', 5),
            'decay_minutes' => 1,
        ],
    ],
];

<?php

namespace Modules\AdminAccess\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

final class LoginAttempt extends Model
{
 protected $table = 'admin_login_attempts';

    public $timestamps = false;

    protected $fillable = ['email', 'ip_address', 'user_agent', 'successful'];

    protected function casts(): array
    {
        return [
            'successful' => 'boolean',
            'attempted_at' => 'datetime',
        ];
    }
}
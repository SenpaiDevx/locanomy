<?php

namespace Modules\AdminAccess\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

final class PasswordHistory extends Model
{
    protected $table = 'admin_password_histories';

    public $timestamps = false;

    protected $fillable = ['admin_id', 'password_hash'];

    protected function casts(): array
    {
        return ['created_at' => 'datetime'];
    }
}
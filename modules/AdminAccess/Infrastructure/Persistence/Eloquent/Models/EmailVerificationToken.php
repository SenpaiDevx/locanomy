<?php

namespace Modules\AdminAccess\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
final class EmailVerificationToken extends Model
{
    protected $table = 'admin_email_verification_tokens';

    protected $fillable = ['admin_id', 'token_hash', 'expires_at', 'consumed_at'];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'consumed_at' => 'datetime',
        ];
    }

    public function admin() : BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
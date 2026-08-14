<?php

namespace Modules\AdminAccess\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
final class InstallationLock extends Model
{
    protected $table = 'admin_installation_lock';

    protected $fillable = ['installed_at', 'installed_by_admin_id'];

    protected $casts = [
        'installed_at' => 'datetime',
    ];
}
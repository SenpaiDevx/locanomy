<?php

namespace Modules\AdminAccess\Models\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PermissionRole extends Pivot
{
    protected $table = 'permission_role';
    
    public $incrementing = false;
    public $timestamps = true;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
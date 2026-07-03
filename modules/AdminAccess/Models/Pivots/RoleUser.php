<?php

namespace Modules\AdminAccess\Models\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;
class RoleUser extends Pivot {

    protected $table = 'role_user';
    
    // Composite key = no auto-incrementing ID
    public $incrementing = false;
    
    // Enable timestamps if your migration includes them
    public $timestamps = true;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
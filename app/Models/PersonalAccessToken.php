<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
class PersonalAccessToken extends SanctumPersonalAccessToken
{
    use HasUlids;
    
    // ULIDs are 26 characters, so adjust column if needed
    public $incrementing = false;
    protected $keyType = 'string';
    
    // The ULID trait handles this automatically, but being explicit
    protected $primaryKey = 'id';
}

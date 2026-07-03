<?php

namespace Modules\AdminAccess\Concerns;

use Modules\AdminAccess\Models\UserProfile;
use Illuminate\Database\Eloquent\Model; // we use PHP doc identifier to extend trait function to Model for typesafe

/**
 * @phpstan-require-extends Model
 * @mixin Model
 */
trait HasUserProfile
{
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function getProfileAttribute()
    {
        
        return $this->profile()->firstOrCreate();
    }
}
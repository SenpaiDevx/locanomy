<?php

namespace Modules\AdminAccess\Concerns;

use Modules\AdminAccess\Enums\UserStatus;
trait HasProfileFields
{
    protected function initializeHasProfileFields(): void
    {
        $this->casts = array_merge($this->casts ?? [], [
            'status' => UserStatus::class,
        ]);
    }

    /** Accessor for full name concatenation */
    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    public function scopeActive($query)
    {
        return $query->where('status', UserStatus::Active);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', UserStatus::Inactive);
    }

    public function scopeSuspended($query)
    {
        return $query->where('status', UserStatus::Suspended);
    }

}
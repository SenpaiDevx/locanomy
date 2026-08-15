<?php

namespace Modules\AdminAccess\Domain\ValueObjects;

enum Status: string
{
    case Active = 'active';
    case Suspended = 'suspended';
    case Locked = 'locked';

    public function isLocked(): bool
    {
        return $this === self::Locked;
    }

    public function isActive(): bool
    {
        return $this === self::Active;
    }
}

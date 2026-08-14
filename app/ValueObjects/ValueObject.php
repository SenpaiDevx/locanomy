<?php

namespace App\ValueObjects;

/**
 * Every Value Object in every module implements this so equality is
 * checked by value, never by reference or identity.
 */
interface ValueObject
{
    public function equals(self $other): bool;
}


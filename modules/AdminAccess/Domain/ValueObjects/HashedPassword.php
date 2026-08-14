<?php

namespace Modules\AdminAccess\Domain\ValueObjects;

use App\ValueObjects\ValueObject;
final class HashedPassword
{
    public function __construct(private readonly string $hash)
    {
        if ($hash === '') {
            throw new \InvalidArgumentException('A hashed password cannot be empty.');
        }
    }

    public function value(): string
    {
        return $this->hash;
    }

    public function equals(ValueObject $other): bool
    {
        return $other instanceof self && hash_equals($this->hash, $other->hash);
    }
}
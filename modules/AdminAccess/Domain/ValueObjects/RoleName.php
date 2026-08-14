<?php

namespace Modules\AdminAccess\Domain\ValueObjects;

use App\ValueObjects\ValueObject;

final class RoleName implements ValueObject
{
    public function __construct(private readonly string $value)
    {
        if (trim($value) === '') {
            throw new \InvalidArgumentException('A role name cannot be empty.');
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(ValueObject $other): bool
    {
        return $other instanceof self && $other->value === $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
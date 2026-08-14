<?php

namespace Modules\AdminAccess\Domain\ValueObjects;
use App\ValueObjects\ValueObject;
final class Email implements ValueObject
{
    private readonly string $value;

    public function __construct(string $value)
    {
        $value = mb_strtolower(trim($value));

        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("'{$value}' is not a valid email address.");
        }

        $this->value = $value;
    }
    
     public function value(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
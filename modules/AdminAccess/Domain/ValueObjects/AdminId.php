<?php

namespace Modules\AdminAccess\Domain\ValueObjects;

use App\ValueObjects\ValueObject;
use Illuminate\Support\Str;
final class AdminId implements ValueObject {

    public function __construct(private readonly string $value){
        if ($value === '' || ! Str::isUuid($value)) {
            throw new \InvalidArgumentException('AdminId must be a non-empty UUID.');
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public static function generate() : self {
         return new self((string) Str::uuid());
    }

    public function equals (ValueObject $other) : bool
    {
        return $other instanceof self && $other->value === $this->value;
    } 

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
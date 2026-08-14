<?php

namespace Modules\AdminAccess\Domain\ValueObjects;

use App\ValueObjects\ValueObject;
use Illuminate\Support\Str;
final class AdminId implements ValueObject {

    public function __construct(private readonly int $value){
        if (!$this->value) {
            throw new \InvalidArgumentException('AdminId cannot be empty.');
        }
    }

    public function value(): int
    {
        return $this->value;
    }   

    public static function generate() : self {
        return new self((string) Str::ulid());
    }

    public function equals (ValueObject $other) : bool
    {
        return $other instanceof self && $other->value == $this->value;
    } 
}
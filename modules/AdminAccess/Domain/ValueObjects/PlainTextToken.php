<?php

namespace Modules\AdminAccess\Domain\ValueObjects;

final class PlainTextToken
{
    private function __construct(private readonly string $value)
    {

    }

    public static function generate() : self
    {
        return new self(bin2hex(random_bytes(32)));
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function hash(): string
    {
        return hash('sha256', $this->value);
    }
}
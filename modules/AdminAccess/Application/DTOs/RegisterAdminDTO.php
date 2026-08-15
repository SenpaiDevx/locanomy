<?php

namespace Modules\AdminAccess\Application\DTOs;

use App\DTO\BaseDTO;

final class RegisterAdminDTO extends BaseDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self($data['name'], $data['email'], $data['password']);
    }

    public function toArray(): array
    {
        // password intentionally omitted — never serialize the secret.
        return ['name' => $this->name, 'email' => $this->email];
    }
}
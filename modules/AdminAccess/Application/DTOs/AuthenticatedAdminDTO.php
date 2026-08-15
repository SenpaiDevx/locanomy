<?php

namespace Modules\AdminAccess\Application\DTOs;

use App\DTO\BaseDTO;

final class AuthenticatedAdminDTO extends BaseDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $email,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self($data['id'], $data['name'], $data['email']);
    }

    public function toArray(): array
    {
        return ['id' => $this->id, 'name' => $this->name, 'email' => $this->email];
    }
}
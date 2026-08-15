<?php

namespace Modules\AdminAccess\Application\DTOs;

use App\DTO\BaseDTO;

final class CreateAdminDTO extends BaseDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly string $createdByAdminId,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self($data['name'], $data['email'], $data['password'], $data['created_by_admin_id']);
    }

    public function toArray(): array
    {
        return ['name' => $this->name, 'email' => $this->email, 'created_by_admin_id' => $this->createdByAdminId];
    }
}
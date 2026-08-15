<?php

namespace Modules\AdminAccess\Application\DTOs;

use App\DTO\BaseDTO;

final class UpdateAdminDTO extends BaseDTO
{
    public function __construct(
        public readonly string $adminId,
        public readonly string $name,
        public readonly string $email,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self($data['admin_id'], $data['name'], $data['email']);
    }

    public function toArray(): array
    {
        return ['admin_id' => $this->adminId, 'name' => $this->name, 'email' => $this->email];
    }
}

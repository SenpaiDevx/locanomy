<?php

namespace Modules\AdminAccess\Application\DTOs;

use App\DTO\BaseDTO;

final class AdminDTO extends BaseDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $status,
        public readonly bool $emailVerified,
        public readonly ?string $createdByAdminId,
    ) {
    }

    public static function fromArray(array $data) : static
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['email'],
            $data['status'],
            $data['email_verified'],
            $data['created_by_admin_id'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'status' => $this->status,
            'email_verified' => $this->emailVerified,
            'created_by_admin_id' => $this->createdByAdminId,
        ];
    }
}
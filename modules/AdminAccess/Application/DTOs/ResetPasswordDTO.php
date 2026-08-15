<?php

namespace Modules\AdminAccess\Application\DTOs;

use App\DTO\BaseDTO;

final class ResetPasswordDTO extends BaseDTO
{
    public function __construct(
        public readonly string $email,
        public readonly string $token,
        public readonly string $newPassword,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self($data['email'], $data['token'], $data['new_password']);
    }

    public function toArray(): array
    {
        // new_password intentionally omitted — never serialize the secret.
        return ['email' => $this->email, 'token' => $this->token];
    }
}   
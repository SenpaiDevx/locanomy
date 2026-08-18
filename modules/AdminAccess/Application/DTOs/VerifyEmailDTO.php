<?php

namespace Modules\AdminAccess\Application\DTOs;

use App\Application\DTO\BaseDTO;

final class VerifyEmailDTO extends BaseDTO
{
    public function __construct(
        public readonly string $email,
        public readonly string $token,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self($data['email'], $data['token']);
    }

    public function toArray(): array
    {
        return ['email' => $this->email, 'token' => $this->token];
    }
}
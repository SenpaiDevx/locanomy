<?php

namespace Modules\AdminAccess\Application\DTOs;

use App\DTO\BaseDTO;

final class LoginDTO extends BaseDTO
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
        public readonly string $ipAddress,
        public readonly string $userAgent,
        public readonly bool $remember,
    ){}

    public function fromArray(array $data) : static
    {
        return new self(
            email : $data['email'],
            password : $data['password'],
            remember : (bool) ($data['remember' ?? false]),
            ipAddress : $data['ip_address'],
            userAgent : $data['user_agent'] ?? ''

        );
    }

    public function toArray() : array
    {
        return [
            'email' => $this->email,
            'remember' => $this->remember,
            'ip_address' => $this->ipAddress,
            'user_agent' => $this->userAgent
        ];
    }


}
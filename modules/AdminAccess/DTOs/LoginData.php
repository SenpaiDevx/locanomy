<?php

namespace Modules\AdminAccess\DTOs;


readonly class LoginData
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
        public readonly bool $remember = false,
    ) {}
}
<?php

namespace Modules\AdminAccess\DTOs;
readonly class UserData 
{
    public function __construct(
        public readonly ?string $id,
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $password = null,
        public readonly ?string $phone = null,
        public readonly ?string $avatar = null,
        public readonly ?string $bio = null,
        public readonly ?string $timezone = 'UTC',
        public readonly ?string $locale = 'en',
        public readonly ?bool $is_active = true,
    ) {}
}
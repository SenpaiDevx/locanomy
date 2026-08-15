<?php

namespace Modules\AdminAccess\Domain\Contracts;

interface PasswordPolicyInterface
{
    public function assertSatisfies(string $plainPassword, array $recentPasswordHashes = []): void;
}
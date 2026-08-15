<?php

namespace Modules\AdminAccess\Domain\Contracts;

use Modules\AdminAccess\Domain\ValueObjects\AdminId;
interface PasswordResetTokenRepositoryInterface
{
    public function issue(AdminId $adminId, string $plainToken, \DateTimeInterface $expiresAt): void;

    public function findValidForUpdate(string $email, string $plainToken): ?object;

    public function consume(string $tokenId): void;
}
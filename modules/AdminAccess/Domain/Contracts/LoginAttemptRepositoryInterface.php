<?php

namespace Modules\AdminAccess\Domain\Contracts;

interface LoginAttemptRepositoryInterface
{
    public function logSuccess(string $email, string $ipAddress, string $userAgent): void;

    public function logFailed(string $email, string $ipAddress, string $userAgent): void;
}
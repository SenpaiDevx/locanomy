<?php

namespace Modules\AdminAccess\Domain\Exceptions;

use App\Domain\Exceptions\DomainException;
final class AccountLockedException extends DomainException
{
    public function __construct(private readonly ?\DateTimeImmutable $lockedUntilAt)
    {
        parent::__construct("This account is temporarily locked.");
    }

    public function lockedUntil(): ?\DateTimeImmutable
    {
        return $this->lockedUntilAt;
    }

    public function errorCode(): string
    {
        return 'admin_access.account_locked';
    }
}
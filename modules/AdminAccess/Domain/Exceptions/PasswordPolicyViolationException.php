<?php

namespace Modules\AdminAccess\Domain\Exceptions;

use App\Domain\Exceptions\DomainException;

final class PasswordPolicyViolationException extends DomainException
{
    public function __construct(private readonly array $violations)
    {
        parent::__construct('Password does not satisfy policy: ' . implode(', ', $violations));
    }

    public function violations(): array
    {
        return $this->violations;
    }

    public function errorCode(): string
    {
        return 'admin_access.password_policy_violation';
    }
}
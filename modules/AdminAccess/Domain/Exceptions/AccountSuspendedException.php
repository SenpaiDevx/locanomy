<?php

namespace Modules\AdminAccess\Domain\Exceptions;

use App\Domain\Exceptions\DomainException;
final class AccountSuspendedException extends DomainException
{
     public function __construct()
    {
        parent::__construct('This account has been deactivated.');
    }

    public function errorCode(): string
    {
        return 'admin_access.account_suspended';
    }

    public function httpStatus(): int
    {
        return 423;
    }
}
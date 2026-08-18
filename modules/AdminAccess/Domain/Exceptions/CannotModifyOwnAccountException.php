<?php

namespace Modules\AdminAccess\Domain\Exceptions;

use App\Domain\Exceptions\DomainException;

final class CannotModifyOwnAccountException extends DomainException
{
    public function __construct()
    {
        parent::__construct('You cannot perform this action on your own account.');
    }

    public function errorCode(): string
    {
        return 'admin_access.cannot_modify_own_account';
    }

    public function httpStatus(): int
    {
        return 403;
    }
}
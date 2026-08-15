<?php

namespace Modules\AdminAccess\Domain\Exceptions;

use App\Exceptions\DomainException;

final class InvalidCredentialsException extends DomainException
{
    public function __construct()
    {
        parent::__construct('These credentials do not match our records.');
    }

    public function errorCode(): string
    {
        return 'admin_access.invalid_credentials';
    }
}


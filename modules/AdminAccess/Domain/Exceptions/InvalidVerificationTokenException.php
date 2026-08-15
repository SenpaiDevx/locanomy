<?php

namespace Modules\AdminAccess\Domain\Exceptions;

use App\Exceptions\DomainException;


final class InvalidVerificationTokenException extends DomainException
{
    public function __construct()
    {
        parent::__construct('This email verification link is invalid or has expired.');
    }

    public function errorCode(): string
    {
        return 'admin_access.invalid_verification_token';
    }
}
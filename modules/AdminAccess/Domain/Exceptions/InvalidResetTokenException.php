<?php

namespace Modules\AdminAccess\Domain\Exceptions;

use App\Domain\Exceptions\DomainException;

final class InvalidResetTokenException extends DomainException
{
      public function __construct()
    {
        parent::__construct('This password reset link is invalid or has expired.');
    }

    public function errorCode(): string
    {
        return 'admin_access.invalid_reset_token';
    }
}
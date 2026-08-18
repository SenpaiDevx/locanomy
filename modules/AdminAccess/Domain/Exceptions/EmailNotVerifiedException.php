<?php

namespace Modules\AdminAccess\Domain\Exceptions;

use App\Domain\Exceptions\DomainException;

final class EmailNotVerifiedException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Please verify your email address before signing in.');
    }

    public function errorCode(): string
    {
        return 'admin_access.email_not_verified';
    }
}
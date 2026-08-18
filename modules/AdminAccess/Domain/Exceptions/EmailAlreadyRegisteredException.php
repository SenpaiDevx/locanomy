<?php

namespace Modules\AdminAccess\Domain\Exceptions;

use App\Domain\Exceptions\DomainException;

final class EmailAlreadyRegisteredException extends DomainException
{
    public function __construct()
    {
        parent::__construct('An admin account with this email already exists.');
    }

    public function errorCode(): string
    {
        return 'admin_access.email_already_registered';
    }
}
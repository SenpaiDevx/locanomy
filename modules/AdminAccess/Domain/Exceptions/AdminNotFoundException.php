<?php

namespace Modules\AdminAccess\Domain\Exceptions;

use App\Domain\Exceptions\DomainException;

final class AdminNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct("Admin not found.");
    }

    public function errorCode(): string
    {
        return 'admin_access.admin_not_found';
    }

    public function httpStatus(): int
    {
        return 404;
    }
}
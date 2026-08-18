<?php

namespace Modules\AdminAccess\Domain\Exceptions;

use App\Domain\Exceptions\DomainException;

final class SystemAlreadyInstalledException extends DomainException
{
    public function __construct()
    {
        parent::__construct('This system has already been installed.');
    }

    public function errorCode(): string
    {
        return 'admin_access.system_already_installed';
    }
}
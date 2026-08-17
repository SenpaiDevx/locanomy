<?php

namespace App\Domain\Exceptions;


/**
 * Every module-level domain exception extends this, so application code
 * can catch `DomainException` at a boundary (a controller, a console
 * command) without needing to know which module raised it.
 */
abstract class DomainException extends \DomainException
{
    abstract public function errorCode(): string;

    public function httpStatus(): int
    {
        return 422;
    }
}
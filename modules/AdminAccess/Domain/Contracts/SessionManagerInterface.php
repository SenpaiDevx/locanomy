<?php

namespace Modules\AdminAccess\Domain\Contracts;


interface SessionManagerInterface
{
    public function start(string $adminId, bool $remember): void;

    public function invalidate(): void;
}
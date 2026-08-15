<?php

namespace Modules\AdminAccess\Domain\Contracts;

interface BreachedPasswordCheckerInterface
{
    public function isBreached(string $plainPassword): bool;
}

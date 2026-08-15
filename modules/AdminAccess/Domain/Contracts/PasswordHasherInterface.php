<?php

namespace Modules\AdminAccess\Domain\Contracts;

use Modules\AdminAccess\Domain\ValueObjects\HashedPassword;
interface PasswordHasherInterface
{
    public function hash(string $plainPassword): HashedPassword;

    public function verify(string $plainPassword, HashedPassword $hash): bool;

    public function needsRehash(HashedPassword $hash): bool;
}
<?php

namespace Modules\AdminAccess\Infrastructure\Security;

use Illuminate\Support\Facades\Hash;
use Modules\AdminAccess\Domain\Contracts\PasswordHasherInterface;
use Modules\AdminAccess\Domain\ValueObjects\HashedPassword;
final class BcryptPasswordHasher implements PasswordHasherInterface
{
    public function hash(string $plainPassword): HashedPassword
    {
        return new HashedPassword(Hash::make($plainPassword));
    }

    public function verify(string $plainPassword, HashedPassword $hash): bool
    {
        return Hash::check($plainPassword, $hash->value());
    }

    public function needsRehash(HashedPassword $hash): bool
    {
        return Hash::needsRehash($hash->value());
    }
}
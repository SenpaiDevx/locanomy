<?php

namespace Modules\AdminAccess\Infrastructure\Security;

use Modules\AdminAccess\Domain\Contracts\ApiTokenIssuerInterface;
use Modules\AdminAccess\Domain\ValueObjects\AdminId;
use Modules\AdminAccess\Infrastructure\Persistence\Eloquent\Models\Admin;
final class SanctumApiTokenIssuer implements ApiTokenIssuerInterface
{
     public function issue(AdminId $adminId, string $tokenName, array $abilities = ['*']): string
     {
        $admin = Admin::findOrFail($adminId->value());
        return $admin->createToken($tokenName, $abilities)->plainTextToken;
     }

     public function revokeAll(AdminId $adminId): void
    {
        Admin::findOrFail($adminId->value())->tokens()->delete();
    }
}
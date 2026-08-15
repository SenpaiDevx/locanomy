<?php

namespace Modules\AdminAccess\Domain\Contracts;

use Modules\AdminAccess\Domain\ValueObjects\AdminId;
interface ApiTokenIssuerInterface
{
    
    public function issue(AdminId $adminId, string $tokenName, array $abilities = ['*']): string;

    public function revokeAll(AdminId $adminId): void;
}
<?php

namespace Modules\AdminAccess\Domain\ValueObjects;

/**
 * Immutable configuration for password strength rules. Constructed from
 * config/admin_access.php by AdminAccessServiceProvider, so the policy
 * is environment-tunable without touching PasswordPolicyEnforcer.
 */
final class PasswordPolicy
{
    public function __construct(
        public readonly int $minLength = 12,
        public readonly bool $requireUppercase = true,
        public readonly bool $requireLowercase = true,
        public readonly bool $requireNumber = true,
        public readonly bool $requireSymbol = true,
        public readonly bool $rejectBreachedPasswords = true,
        public readonly int $historyLimit = 10,
        public readonly ?int $expiresAfterDays = null,
    ) {
    }
}
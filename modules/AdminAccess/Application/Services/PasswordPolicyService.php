<?php

namespace Modules\AdminAccess\Application\Services;

use Modules\AdminAccess\Domain\Contracts\BreachedPasswordCheckerInterface;
use Modules\AdminAccess\Domain\Contracts\PasswordHasherInterface;
use Modules\AdminAccess\Domain\Contracts\PasswordPolicyInterface;
use Modules\AdminAccess\Domain\Exceptions\PasswordPolicyViolationException;
use Modules\AdminAccess\Domain\ValueObjects\HashedPassword;
final class PasswordPolicyService implements PasswordPolicyInterface
{
    public function __construct(
        private readonly PasswordHasherInterface $hasher,
        private readonly BreachedPasswordCheckerInterface $breachChecker,
        private readonly int $minLength,
        private readonly int $historyLimit,
    ) {}

    public function assertSatisfies(string $plainPassword, array $recentPasswordHashes = []): void
    {
        $violations = [];

        if (mb_strlen($plainPassword) < $this->minLength) {
            $violations[] = 'min_length';
        }
        if (! preg_match('/[A-Z]/', $plainPassword)) {
            $violations[] = 'uppercase';
        }
        if (! preg_match('/[a-z]/', $plainPassword)) {
            $violations[] = 'lowercase';
        }
        if (! preg_match('/[0-9]/', $plainPassword)) {
            $violations[] = 'digit';
        }
        if (! preg_match('/[^A-Za-z0-9]/', $plainPassword)) {
            $violations[] = 'special_char';
        }
        if ($this->breachChecker->isBreached($plainPassword)) {
            $violations[] = 'breached';
        }
        if ($this->reusesRecentPassword($plainPassword, $recentPasswordHashes)) {
            $violations[] = 'reused_password';
        }

        if ($violations !== []) {
            throw new PasswordPolicyViolationException($violations);
        }
    }

    private function reusesRecentPassword(string $plainPassword, array $recentPasswordHashes): bool
    {
        foreach (array_slice($recentPasswordHashes, -$this->historyLimit) as $previousHash) {
            if ($this->hasher->verify($plainPassword, new HashedPassword($previousHash))) {
                return true;
            }
        }

        return false;
    }
}
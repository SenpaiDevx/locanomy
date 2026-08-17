<?php

namespace Modules\AdminAccess\Domain\Events;

use App\Domain\Contracts\IdempotentDomainEvent;
use App\Domain\Events\HasIdempotencyKey;
/**
 * Fired exactly once per deployment — when the very first super-admin is
 * created via the setup wizard. Distinct from AdminCreated: that event
 * fires for every admin an existing admin provisions; this one is a
 * one-time "the system is now bootstrapped" milestone, which is why it
 * carries no token and exists purely for the audit trail.
 *
 * Implements IdempotentDomainEvent with a key stable per admin id: this
 * genuinely should only ever fire once, so LogSystemInstallationListener
 * dedupes against a redelivery rather than risking a confusing second
 * "system installed" log line.
 */
final class SystemInstalled implements IdempotentDomainEvent
{
    use HasIdempotencyKey;

    public function __construct(
        public readonly string $adminId,
        public readonly string $email,
        private readonly \DateTimeImmutable $occurredAt,
    ) {
        $this->setIdempotencyKey('admin_access.system_installed:' . $adminId);
    }

    public function eventName(): string
    {
        return 'admin_access.system_installed';
    }

    public function occurredAt(): \DateTimeImmutable
    {
        return $this->occurredAt;
    }

    public function toArray(): array
    {
        return [
            'admin_id' => $this->adminId,
            'email' => $this->email,
            'occurred_at' => $this->occurredAt->format(DATE_ATOM),
        ];
    }
}
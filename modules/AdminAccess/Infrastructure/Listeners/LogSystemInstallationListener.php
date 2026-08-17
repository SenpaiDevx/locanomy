<?php

namespace Modules\AdminAccess\Infrastructure\Listeners;

use Illuminate\Support\Facades\Log;
use App\Infrastructure\EventBus\IdempotentListener;
use Modules\AdminAccess\Domain\Events\SystemInstalled;


/**
 * Reuses the same 'security' channel NotifySecurityOfAccountLockoutListener
 * already writes to, rather than introducing a new channel for a single
 * one-time event — "the system was just installed, by this admin, at
 * this time" belongs in the same audit trail as other security-relevant
 * account events.
 *
 * Wrapped in onceFor(): SystemInstalled should log exactly once ever —
 * see the event's own docblock for why it's an IdempotentDomainEvent.
 */
final class LogSystemInstallationListener
{
    use IdempotentListener;

    public function handle(SystemInstalled $event): void
    {
        $this->onceFor($event, function () use ($event): void {
            Log::channel('security')->notice('System installed: first super-admin account created.', $event->toArray());
        });
    }
}
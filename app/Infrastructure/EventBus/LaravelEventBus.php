<?php

namespace App\Infrastructure\EventBus;

use App\Domain\Contracts\{DomainEvent, EventBusInterface};
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\DB;

/**
 * "Monolith-safe" event bus: no broker, no network hop — Laravel's own
 * dispatcher sits underneath — but every module talks to EventBusInterface,
 * never to Illuminate\Events directly. That seam is what lets AdminAccess
 * announce "an admin logged in" without knowing or caring which, if any,
 * other module is listening (explicit event-driven communication for the
 * right dependency direction: dependents point at the bus, never at each
 * other).
 *
 * publishAfterCommit() is the part that makes it "safe": events are
 * queued on DB::afterCommit() so a listener — including one that queues
 * a job onto Redis/SQS — can never fire against a row that hasn't been
 * committed yet.
 */
final class LaravelEventBus implements EventBusInterface
{
    public function __construct(private readonly Dispatcher $dispatcher)
    {
    }

    public function publish(DomainEvent $event): void
    {
        $this->dispatcher->dispatch($event);
    }

    public function publishAfterCommit(array $events): void
    {
        foreach ($events as $event) {
            if (DB::transactionLevel() > 0) {
                DB::afterCommit(fn() => $this->dispatcher->dispatch($event));
                continue;
            }

            // No open transaction (e.g. invoked from a console command) —
            // there's nothing to wait for, so dispatch immediately.
            $this->dispatcher->dispatch($event);
        }
    }
}
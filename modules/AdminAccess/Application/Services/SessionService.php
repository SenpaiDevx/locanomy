<?php

namespace Modules\AdminAccess\Application\Services;

use Modules\AdminAccess\Domain\Contracts\SessionManagerInterface;
final class SessionService {

    public function __construct(private readonly SessionManagerInterface $sessions)
    {
    }

    public function startFor(string $adminId, bool $remember): void
    {
        $this->sessions->start($adminId, $remember);
    }

    public function terminate(): void
    {
        $this->sessions->invalidate();
    }
}
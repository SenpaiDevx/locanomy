<?php

namespace Modules\AdminAccess\Infrastructure\Security;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\AdminAccess\Domain\Contracts\SessionManagerInterface;
final class GuardSessionManager implements SessionManagerInterface
{
    public function start(string $adminId, bool $remember): void
    {
        Session::regenerate();
        Auth::guard('admin')->loginUsingId($adminId, $remember);
    }

     public function invalidate(): void
    {
        Auth::guard('admin')->logout();
        Session::invalidate();
        Session::regenerateToken();
    }
}
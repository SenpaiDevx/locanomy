<?php

namespace Modules\AdminAccess\Infrastructure\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\AdminAccess\Domain\Contracts\InstallationInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Applied to every admin route (both Routes/web.php and Routes/api.php —
 * see each file's route group). Uses the FAST, CACHED
 * SystemInstallationRepositoryInterface::isInstalled() check — this is a
 * UX gate, not the security boundary. The security boundary is the
 * transaction-scoped claimInstallationForUpdate() inside
 * RunSetupWizardAction; even if this middleware were somehow bypassed or
 * its cache were stale, a second "first admin" submission would still be
 * rejected there.
 */
final class RedirectIfNotInstalled
{
    public function __construct(private readonly InstallationInterface $installation)
    {

    }

    public function handle(Request $request, Closure $next): Response
    {
        $isSetupRoute = str_ends_with((string) $request->route()?->getName(), '.setup.show')
            || str_ends_with((string) $request->route()?->getName(), '.setup.store');

        $installed = $this->installation->isInstalled();

        if (!$installed && !$isSetupRoute) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'This admin panel has not been set up yet.',
                    'setup_url' => route('admin_access.web.setup.show'),
                ], 503);
            }

            return redirect()->route('admin_access.web.setup.show');
        }

        // Installed + still trying to reach the setup screen: it never
        // shows again, full stop — no redirect, no "already installed"
        // message that would confirm to an anonymous visitor whether
        // setup has run. A flat 404 reveals nothing either way.
        
        if ($installed && $isSetupRoute) {
            abort(404);
        }

        return $next($request);
    }
}
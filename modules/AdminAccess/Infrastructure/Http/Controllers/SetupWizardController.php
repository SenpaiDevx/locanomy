<?php

namespace Modules\AdminAccess\Infrastructure\Http\Controllers;

use Inertia\{Inertia, Response};
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\AdminAccess\Application\Actions\SetupWizardAction;
use Modules\AdminAccess\Application\DTOs\RegisterAdminDTO;
use Modules\AdminAccess\Application\Services\SessionService;
use Modules\AdminAccess\Domain\Exceptions\{
    PasswordPolicyViolationException,
    SystemAlreadyInstalledException
};
use Modules\AdminAccess\Infrastructure\Http\Requests\RegisterAdminRequest;
final class SetupWizardController extends Controller
{

    public function __construct(
        private readonly SetupWizardAction $setup,
        private readonly SessionService $sessions,
    ) {
    }
    public function index(): Response
    {
        return Inertia::render('welcome');
    }

    public function store(RegisterAdminRequest $request): RedirectResponse
    {
        try {
            $admin = $this->setup->execute(RegisterAdminDTO::fromArray([
                'name' => $request->string('name')->toString(),
                'email' => $request->string('email')->toString(),
                'password' => $request->string('password')->toString(),
            ]));
        } catch (SystemAlreadyInstalledException) {
             return redirect()->to(config('admin_access.setup.redirect_route'))
                ->withErrors(['setup' => 'This system has already been set up. Please sign in.']);
        } catch (PasswordPolicyViolationException $e) {
             return back()->withErrors(['password' => 'Password does not meet policy requirements.'])
                ->with('violations', $e->violations())
                ->withInput($request->except('password', 'password_confirmation'));
        }

         $this->sessions->startFor($admin->id, remember: false);

        return redirect()->to(config('admin_access.setup.redirect_route'));
    }

}
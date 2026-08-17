<?php

namespace Modules\AdminAccess\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Contracts\EventBusInterface;
use Modules\AdminAccess\Domain\Events\SystemInstalled;
use Modules\AdminAccess\Application\DTOs\{AuthenticatedAdminDTO, RegisterAdminDTO};
use Modules\AdminAccess\Application\Services\PasswordPolicyService;               
use Modules\AdminAccess\Domain\Contracts\{
    AdminRepositoryInterface,
    PasswordHasherInterface,
    RoleManagerInterface,
    InstallationInterface
};
use Modules\AdminAccess\Domain\Exceptions\SystemAlreadyInstalledException; 
use Modules\AdminAccess\Domain\Models\Admin;
use Modules\AdminAccess\Domain\ValueObjects\{AdminId, Email, RoleName};
final class SetupWizardAction {
    
}
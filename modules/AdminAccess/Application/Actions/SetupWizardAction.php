<?php

namespace Modules\AdminAccess\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Domain\Contracts\EventBusInterface;
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
final class SetupWizardAction  {
    public function __construct(
        private readonly AdminRepositoryInterface $admin,
        private readonly PasswordHasherInterface $hasher,
        private readonly PasswordPolicyService $policy,
        private readonly RoleManagerInterface $role,
        private readonly InstallationInterface $installation,
        private readonly EventBusInterface $events,
        private readonly string $superAdminRole, // closure variable for passing config() value at runtime

    ){}

    public function execute (RegisterAdminDTO $dto) : AuthenticatedAdminDTO
    {
        return DB::transaction(function () use ($dto) {
            if ($this->installation->claimInstallationForUpdate()){
                throw new SystemAlreadyInstalledException();
            }

            $this->policy->assertSatisfies($dto->password, []);

             $admin = Admin::register(
                id: AdminId::generate(),
                name: $dto->name,
                email: new Email($dto->email),
                password: $this->hasher->hash($dto->password),
            );

            $this->admin->save($admin);
            $this->role->assignRole($admin->id(), RoleName::fromString($this->superAdminRole));
            $this->installation->markInstalled($admin->id());

            $this->events->publishAfterCommit([
                new SystemInstalled($admin->id(), $admin->email()->value(), new \DateTimeImmutable())
            ]);

             return new AuthenticatedAdminDTO(
                id: $admin->id()->value(),
                name: $admin->name(),
                email: $admin->email()->value(),
            );
        });
    }
}
<?php

namespace Modules\AdminAccess\Domain\Contracts;

use Modules\AdminAccess\Domain\Models\Admin;
use Modules\AdminAccess\Domain\ReadModel\AdminPage;
use Modules\AdminAccess\Domain\ValueObjects\{AdminId, Status, Email};
interface AdminRepositoryInterface
{
    public function findById(AdminId $id): ?Admin;

    public function findByEmail(Email $email): ?Admin;

    public function findByEmailForUpdate(Email $email): ?Admin;

    public function findByIdForUpdate(AdminId $id): ?Admin;

    public function create(Admin $admin): void;

    public function save(Admin $admin): void;

    public function paginate(int $page, int $perPage, ?string $search = null, ?Status $status = null): AdminPage;

    public function delete(Admin $admin): void;
}
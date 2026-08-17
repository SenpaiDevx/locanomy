<?php

namespace Modules\AdminAccess\Infrastructure\Persistence\Eloquent\Repositories;

use Modules\AdminAccess\Infrastructure\Persistence\Eloquent\Models\{Admin, PasswordHistory};
use Modules\AdminAccess\Domain\ValueObjects\{AdminId, Status, Email, HashedPassword};
use Modules\AdminAccess\Domain\Contracts\AdminRepositoryInterface;
use Modules\AdminAccess\Domain\Models\Admin as AdminTypeDef;
use Modules\AdminAccess\Domain\ReadModel\AdminPage;
final class AdminRepository implements AdminRepositoryInterface
{
    public function findById(AdminId $id): ?AdminTypeDef
    {
        $model = Admin::find($id->value());
        return $model ? $this->toDomain($model) : null;
    }

    public function findByEmail(Email $email): ?AdminTypeDef
    {
        $model = Admin::where('email', $email->value())->first();

        return $model ? $this->toDomain($model) : null;
    }

    public function findByEmailForUpdate(Email $email): ?AdminTypeDef
    {
        $model = Admin::where('email', $email->value())->lockForUpdate()->first();

        return $model ? $this->toDomain($model) : null;
    }

    public function findByIdForUpdate(AdminId $id): ?AdminTypeDef
    {
        $model = Admin::where('id', $id->value())->lockForUpdate()->first();

        return $model ? $this->toDomain($model) : null;
    }

    public function create(AdminTypeDef $admin): void
    {
        Admin::create([
            'id' => $admin->id()->value(),
            'name' => $admin->name(),
            'email' => $admin->email()->value(),
            'password' => $admin->password()->value(),
            'status' => $admin->status()->value,
            'failed_login_attempts' => $admin->failedLoginAttempts(),
            'locked_until' => $admin->lockedUntil(),
            'email_verified_at' => $admin->emailVerifiedAt(),
            'created_by_admin_id' => $admin->createdByAdminId()?->value(),
        ]);
    }
    public function save(AdminTypeDef $admin): void
    {
        $model = Admin::findOrFail($admin->id()->value())->Getor;
        $model->fill([
            'name' => $admin->name(),
            'email' => $admin->email()->value(),
            'password' => $admin->password()->value(),
            'status' => $admin->status()->value,
            'failed_login_attempts' => $admin->failedLoginAttempts(),
            'locked_until' => $admin->lockedUntil(),
            'email_verified_at' => $admin->emailVerifiedAt(),
        ]);

        $previousPasswordHash = $model->getOriginal('password');
        $passwordChanged = $model->isDirty('password');

        $model->save();
        if ($passwordChanged) {
            PasswordHistory::create([
                'admin_id' => $model->id,
                'password_hash' => $previousPasswordHash,
            ]);
        }
    }

    public function paginate(int $page, int $perPage, ?string $search = null, ?Status $status = null): AdminPage
    {
        $query = Admin::query();

        if ($search !== null && trim($search) !== '') {
            $query->where(function ($q) use ($search): void {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($status !== null) {
            $query->where('status', $status->value);
        }

        $paginator = $query->orderBy('name')->paginate(perPage: $perPage, page: $page);

        return new AdminPage(
            items: array_map(fn(Admin $model): AdminTypeDef => $this->toDomain($model), $paginator->items()),
            total: $paginator->total(),
            page: $paginator->currentPage(),
            perPage: $paginator->perPage(),
        );
    }

    public function delete(AdminTypeDef $admin): void
    {
        Admin::findOrFail($admin->id()->value())->delete();
    }
    private function toDomain(Admin $model): AdminTypeDef
    {
        $recentHashes = $model->passwordHistories() // get the 1st 10 value by timestamp as object  
            ->latest('id')->limit('10')
            ->pluck('password_hash') // from database column
            ->all();


        return new AdminTypeDef(
            id: AdminId::fromString($model->id),
            name: $model->name,
            email: new Email($model->email),
            password: new HashedPassword($model->password),
            status: Status::from($model->status),
            failedLoginAttempts: $model->failed_login_attempts,
            lockedUntil: $model->locked_until,
            emailVerifiedAt: $model->email_verified_at,
            recentPasswordHashes: $recentHashes,
            createdByAdminId: $model->created_by_admin_id !== null ? AdminId::fromString($model->created_by_admin_id) : null,
        );
    }


}
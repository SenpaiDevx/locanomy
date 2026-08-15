<?php

namespace Modules\AdminAccess\Domain\Models;

use Modules\AdminAccess\Domain\ValueObjects\{AdminId, Status, Email, HashedPassword};
final class Admin
{
    private array $recentPasswordHashes;
    public function __construct(
         private readonly AdminId $id,
        private readonly string $name,
        private readonly Email $email,
        private HashedPassword $password,
        private Status $status,
        private int $failedLoginAttempts,
        private ?\DateTimeImmutable $lockedUntil,
        private ?\DateTimeImmutable $emailVerifiedAt,
        array $recentPasswordHashes = [],
        private readonly ?AdminId $createdByAdminId = null,
    ){
        $this->recentPasswordHashes = $recentPasswordHashes;
    }

    public static function register(
        AdminId $id,
        string $name,
        Email $email,
        HashedPassword $password,
        ?AdminId $createdByAdminId = null,
    ): self {
        return new self(
            id: $id,
            name: $name,
            email: $email,
            password: $password,
            status: Status::Active,
            failedLoginAttempts: 0,
            lockedUntil: null,
            emailVerifiedAt: null,
            recentPasswordHashes: [],
            createdByAdminId: $createdByAdminId,
        );
    }

    public function id(): AdminId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function password(): HashedPassword
    {
        return $this->password;
    }

    public function status(): Status
    {
        return $this->status;
    }

    public function createdByAdminId(): ?AdminId
    {
        return $this->createdByAdminId;
    }

    public function isEmailVerified(): bool
    {
        return $this->emailVerifiedAt !== null;
    }

    public function emailVerifiedAt(): ?\DateTimeImmutable
    {
        return $this->emailVerifiedAt;
    }

    public function isLocked(): bool
    {
        return $this->status->isLocked()
            || ($this->lockedUntil !== null && $this->lockedUntil > new \DateTimeImmutable());
    }

    public function isSuspended(): bool
    {
        return $this->status === Status::Suspended;
    }

     public function canAuthenticate(): bool
    {
        return ! $this->isSuspended() && ! $this->isLocked();
    }

    public function suspend(): void
    {
        if ($this->status === Status::Active) {
            $this->status = Status::Suspended;
        }
    }

    public function reactivate(): void
    {
        if ($this->status === Status::Suspended) {
            $this->status = Status::Active;
        }
    }

    public function failedLoginAttempts(): int
    {
        return $this->failedLoginAttempts;
    }

    public function lockedUntil(): ?\DateTimeImmutable
    {
        return $this->lockedUntil;
    }

    public function recentPasswordHashes(): array
    {
        return $this->recentPasswordHashes;
    }

    public function recordFailedLogin(int $maxAttempts, int $lockoutMinutes): void
    {
        $this->failedLoginAttempts++;

        if ($this->failedLoginAttempts >= $maxAttempts) {
            $this->lockedUntil = new \DateTimeImmutable("+{$lockoutMinutes} minutes");
        }
    }

    public function recordSuccessfulLogin(): void
    {
        $this->failedLoginAttempts = 0;
        $this->lockedUntil = null;
    }

    public function changePassword(HashedPassword $newPassword): void
    {
        $this->recentPasswordHashes[] = (string) $this->password;
        $this->password = $newPassword;
    }

    public function markEmailVerified(): void
    {
        if ($this->emailVerifiedAt === null) {
            $this->emailVerifiedAt = new \DateTimeImmutable();
        }
    }
}   
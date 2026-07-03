<?php

namespace Modules\AdminAccess\Concerns;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Notifications\Notifiable;

trait HasAuthFields
{
    use Authenticatable, CanResetPasswordTrait, Notifiable;

    protected function initializeHasAuthFields () : void
    {
        $this->casts =array_merge($this->casts ?? [], [
            'email_verified_at' => 'datetime',
            'last_login_at'     => 'datetime',
            'password'          => 'hashed', // Laravel 11+ auto-hashing
        ]);;
    }

    public function getAuthIdentifierName() : string { return 'id'; }
    public function getAuthIdentifier() : mixed { return $this->getKey(); }
    public function getAuthPassword() : string { return $this->password; }
    public function getRememberToken(): ?string { return $this->remember_token; }
    public function setRememberToken($value): void { $this->remember_token = $value; }
    public function getRememberTokenName(): string { return 'remember_token'; }

    public function hasVerifiedEmail(): bool
    {
        return $this->email_verified_at !== null;
    }

    public function markEmailAsVerified(): bool
    {
         return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function getEmailForPasswordReset(): string { return $this->email; }

     public function recordLogin(): void
    {
        $this->forceFill(['last_login_at' => $this->freshTimestamp()])->save();
    }
}

<?php

namespace Modules\AdminAccess\DTOs;

use illuminate\Validation\Rule;
use Modules\AdminAccess\Enums\UserStatus;
readonly class RegisterUserDTO
{
    public function __construct(
        public string $email,
        public string $password,
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $phone = null,
        public array $roleIds = [],
        public UserStatus $status = Userstatus::Active
    ) {
    }

    public static function fromRequest(array $data): self
    {
        return new self(
            email: $data['email'],
            password: $data['password'],
            firstName: $data['first_name'] ?? null,
            lastName: $data['last_name'] ?? null,
            phone: $data['phone'] ?? null,
            roleIds: $data['role_ids'] ?? [],
            status: UserStatus::tryFrom($data['status'] ?? 'active') ?? UserStatus::Active
        );
    }

    public static function rules(): array
    {
        return [
            'first_name' => ['nullable', 'string', 'max::255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'string', 'max:50', 'regex:/^[\+]?[0-9\s\-\(\)]{6,15}$/'],
            'role_ids' => ['nullable', 'array'],
            'role_ids.*' => ['required', 'string', 'ulid', 'exists:roles,id'], // ✅ ULID enforced
            'status' => ['nullable', 'string', Rule::enum(UserStatus::class)],
        ];
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'password' => $this->password, // Pass raw to Service for hashing
            'phone' => $this->phone,
            'status' => $this->status->value,
        ];
    }
}
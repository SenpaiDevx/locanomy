<?php

namespace Modules\AdminAccess\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
final class RegisterAdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            // Base sanity check only, same split as ResetPasswordRequest:
            // PasswordPolicyService is the real source of truth for
            // complexity/breach rules.
            'password' => ['required', 'string', 'min:12', 'confirmed'],
        ];
    }
}
<?php

namespace Modules\AdminAccess\Application\DTOs;

use App\Application\DTO\BaseDTO;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
#[TypeScript(location: ['admin', 'types'])]
final class ForgotPasswordDTO extends BaseDTO
{
    public function __construct(public readonly string $email)
    {
    }

    public static function fromArray(array $data): static
    {
        return new self($data['email']);
    }

    public function toArray(): array
    {
        return ['email' => $this->email];
    }
}
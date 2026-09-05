<?php

namespace Modules\AdminAccess\Application\DTOs;

use App\Application\DTO\BaseDTO;
use Modules\AdminAccess\Domain\ValueObjects\Email;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
#[TypeScript(location: ['admin', 'types'])]
final class SetupAdminDTO extends BaseDTO {
    public function __construct(
        private readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: new Email($data['email']),
            password: $data['password'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email->value(),
            // password intentionally omitted, same convention as LoginDTO.
        ];
    }
}

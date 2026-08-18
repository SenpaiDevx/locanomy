<?php

namespace Modules\AdminAccess\Application\DTOs;

use App\Application\DTO\BaseDTO;

final class AdminListDTO extends BaseDTO
{
    /** @param AdminDTO[] $items */
    public function __construct(
        public readonly array $items,
        public readonly int $total,
        public readonly int $page,
        public readonly int $perPage,
        public readonly int $lastPage,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            array_map(fn (array $a): AdminDTO => AdminDTO::fromArray($a), $data['items']),
            $data['total'],
            $data['page'],
            $data['per_page'],
            $data['last_page'],
        );
    }

    public function toArray(): array
    {
        return [
            'items' => array_map(fn (AdminDTO $a): array => $a->toArray(), $this->items),
            'total' => $this->total,
            'page' => $this->page,
            'per_page' => $this->perPage,
            'last_page' => $this->lastPage,
        ];
    }
}
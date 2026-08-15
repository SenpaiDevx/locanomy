<?php

namespace Modules\AdminAccess\Domain\ReadModel;

use Modules\AdminAccess\Domain\Models\Admin;
final class AdminPage
{
/** @param Admin[] $items */    
    public function __construct(
        public readonly array $items,
        public readonly int $total,
        public readonly int $page,
        public readonly int $perPage,
    ) {
    }

    public function lastPage(): int
    {
        return (int) max(1, ceil($this->total / max(1, $this->perPage)));
    }
}
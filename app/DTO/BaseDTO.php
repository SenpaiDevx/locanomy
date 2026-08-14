<?php

namespace App\DTO;

/**
 * Base for every cross-layer DTO in the platform. DTOs are plain,
 * immutable data carriers — they never contain business logic beyond
 * shaping/mapping data, which keeps them honest about their one job.
 */
abstract class BaseDTO
{
    /**
     * @return array<string, mixed>
     */
    abstract public function toArray(): array;
}
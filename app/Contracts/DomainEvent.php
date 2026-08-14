<?php

namespace App\Contracts;

interface DomainEvent
{
    public function occurred() : \DateTimeImmutablel;
}
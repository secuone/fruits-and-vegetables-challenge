<?php

declare(strict_types=1);

namespace VeggieVibe\Shared\Domain;

interface UuidValidator
{
    public function isValid(string $uuid): bool;
}
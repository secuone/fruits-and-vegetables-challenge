<?php

declare(strict_types=1);

namespace VeggieVibe\Shared\Infrastructure\Symfony;

use VeggieVibe\Shared\Domain\UuidValidator;
use Symfony\Component\Uid\Uuid;

final class SymfonyUuidValidator implements UuidValidator
{
    public function isValid(string $uuid): bool
    {
        return Uuid::isValid($uuid);
    }
}
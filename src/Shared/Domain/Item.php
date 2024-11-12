<?php

declare(strict_types=1);

namespace VeggieVibe\Shared\Domain;

use VeggieVibe\Shared\Domain\Uuid;
use VeggieVibe\Shared\Domain\ValueObject\StringValueObject;
use VeggieVibe\Shared\Domain\ValueObject\Weight;

interface Item
{
    public function id(): Uuid;
    public function name(): StringValueObject;
    public function quantity(): Weight;
    public function toArray(): array;
}
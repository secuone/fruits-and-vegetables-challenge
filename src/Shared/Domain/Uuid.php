<?php

declare(strict_types=1);

namespace VeggieVibe\Shared\Domain;

use Stringable;

interface Uuid extends Stringable
{
    public function value(): string;
    public function equals(self $other): bool;
}
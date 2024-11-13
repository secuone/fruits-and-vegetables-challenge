<?php

declare(strict_types=1);

namespace VeggieVibe\Shared\Domain;

abstract class ItemCollection
{
    public function __construct(private readonly array $items = []) {}

    public function items(): array
    {
        return $this->items;
    }
}
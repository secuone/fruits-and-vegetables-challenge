<?php

declare(strict_types=1);

namespace VeggieVibe\Shared\Domain;

final class PrimitiveItem
{
    public function __construct(
        private readonly int|string $id,
        private readonly string $name,
        private readonly ?string $type,
        private readonly float $quantity,
        private readonly string $unit,
    ) {}

    public function id(): int|string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function type(): ?string
    {
        return $this->type;
    }

    public function quantity(): float
    {
        return $this->quantity;
    }

    public function unit(): string
    {
        return $this->unit;
    }
}
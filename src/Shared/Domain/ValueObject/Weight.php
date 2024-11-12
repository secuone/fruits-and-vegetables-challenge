<?php

declare(strict_types=1);

namespace VeggieVibe\Shared\Domain\ValueObject;

use InvalidArgumentException;

abstract class Weight
{
    public function __construct(
        private readonly float $value,
        private readonly WeightUnit $unit
    ) {
        $this->ensurePositiveValue($value);
    }

    final public function value(): float
    {
        return $this->value;
    }

    final public function unit(): WeightUnit
    {
        return $this->unit;
    }

    final public function convertToGrams(): float
    {
        return $this->value * $this->unit->toBaseUnit();
    }

    final public function equals(Weight $other): bool
    {
        return $this->convertToGrams() === $other->convertToGrams();
    }

    private function ensurePositiveValue(float $value): void
    {
        if ($this->value < 0) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', self::class, $value));
        }
    }
}
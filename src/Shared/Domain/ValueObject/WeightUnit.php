<?php

declare(strict_types=1);

namespace VeggieVibe\Shared\Domain\ValueObject;

enum WeightUnit: string
{
    case G = 'g';
    case KG = 'kg';

	public function toBaseUnit(): float
    {
        return match($this) 
        {
            self::G => 1.0,
    		self::KG => 1000.0
        };
    }
}
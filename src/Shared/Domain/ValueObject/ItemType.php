<?php

declare(strict_types=1);

namespace VeggieVibe\Shared\Domain\ValueObject;

use VeggieVibe\Fruit\Domain\Fruit;
use VeggieVibe\Vegetable\Domain\Vegetable;

enum ItemType: string
{
    case FRUIT = 'fruit';
    case VEGETABLE = 'vegetable';

    public final function class(): string
    {
        return match ($this) {
            self::FRUIT => Fruit::class,
            self::VEGETABLE => Vegetable::class,
        };
    }
}
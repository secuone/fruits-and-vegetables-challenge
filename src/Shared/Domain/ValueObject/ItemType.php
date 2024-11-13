<?php

declare(strict_types=1);

namespace VeggieVibe\Shared\Domain\ValueObject;

enum ItemType: string
{
    case FRUIT = 'fruit';
    case VEGETABLE = 'vegetable';
}
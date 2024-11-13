<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Shared\Domain;

use VeggieVibe\Shared\Domain\PrimitiveItem;
use VeggieVibe\Shared\Domain\ValueObject\ItemType;
use VeggieVibe\Shared\Domain\ValueObject\WeightUnit;
use VeggieVibe\Tests\Shared\Domain\FloatMother;
use VeggieVibe\Tests\Shared\Domain\UuidMother;
use VeggieVibe\Tests\Shared\Domain\WordMother;

final class PrimitiveItemMother
{
	public static function create(
		?string $id = null,
		?string $name = null,
		?string $type = null,
        ?string $quantity = null,
        ?string $unit = null,
	): PrimitiveItem {
		return new PrimitiveItem(
            $id ?? UuidMother::create(),
            $name ?? WordMother::create(),
            $type ?? ItemType::FRUIT->value,
            $quantity ?? FloatMother::create(),
            $unit ?? WeightUnit::G->value
		);
	}
}
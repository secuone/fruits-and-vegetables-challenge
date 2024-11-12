<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Fruit\Domain;

use VeggieVibe\Fruit\Domain\FruitId;
use VeggieVibe\Tests\Shared\Domain\UuidMother;

final class FruitIdMother
{
	public static function create(?string $value = null): FruitId
	{
		return new FruitId($value ?? UuidMother::create());
	}
}
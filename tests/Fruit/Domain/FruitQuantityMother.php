<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Fruit\Domain;

use VeggieVibe\Fruit\Domain\FruitQuantity;
use VeggieVibe\Tests\Shared\Domain\FloatMother;
use VeggieVibe\Shared\Domain\ValueObject\WeightUnit;

final class FruitQuantityMother
{
	public static function create(?float $value = null, ?WeightUnit $unit = null): FruitQuantity
	{
		return new FruitQuantity(
			$value ?? FloatMother::create(),
			$unit ?? WeightUnit::G
		);
	}
}
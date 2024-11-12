<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Vegetable\Domain;

use VeggieVibe\Vegetable\Domain\VegetableQuantity;
use VeggieVibe\Tests\Shared\Domain\FloatMother;
use VeggieVibe\Shared\Domain\ValueObject\WeightUnit;

final class VegetableQuantityMother
{
	public static function create(?float $value = null, ?WeightUnit $unit = null): VegetableQuantity
	{
		return new VegetableQuantity(
			$value ?? FloatMother::create(),
			$unit ?? WeightUnit::G
		);
	}
}
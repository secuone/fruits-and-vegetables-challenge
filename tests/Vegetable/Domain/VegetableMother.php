<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Vegetable\Domain;

use VeggieVibe\Vegetable\Domain\Vegetable;
use VeggieVibe\Vegetable\Domain\VegetableId;
use VeggieVibe\Vegetable\Domain\VegetableName;
use VeggieVibe\Vegetable\Domain\VegetableQuantity;

final class VegetableMother
{
	public static function create(
		?VegetableId $id = null,
		?VegetableName $name = null,
		?VegetableQuantity $quantity = null
	): Vegetable {
		return new Vegetable(
			$id ?? VegetableIdMother::create(),
			$name ?? VegetableNameMother::create(),
			$quantity ?? VegetableQuantityMother::create()
		);
	}
}
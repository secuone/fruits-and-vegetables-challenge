<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Fruit\Domain;

use VeggieVibe\Fruit\Domain\Fruit;
use VeggieVibe\Fruit\Domain\FruitId;
use VeggieVibe\Fruit\Domain\FruitName;
use VeggieVibe\Fruit\Domain\FruitQuantity;

final class FruitMother
{
	public static function create(
		?FruitId $id = null,
		?FruitName $name = null,
		?FruitQuantity $quantity = null
	): Fruit {
		return new Fruit(
			$id ?? FruitIdMother::create(),
			$name ?? FruitNameMother::create(),
			$quantity ?? FruitQuantityMother::create()
		);
	}
}
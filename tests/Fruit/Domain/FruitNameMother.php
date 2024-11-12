<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Fruit\Domain;

use VeggieVibe\Fruit\Domain\FruitName;
use VeggieVibe\Tests\Shared\Domain\WordMother;

final class FruitNameMother
{
	public static function create(?string $value = null): FruitName
	{
		return new FruitName($value ?? WordMother::create());
	}
}
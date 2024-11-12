<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Vegetable\Domain;

use VeggieVibe\Vegetable\Domain\VegetableId;
use VeggieVibe\Tests\Shared\Domain\UuidMother;

final class VegetableIdMother
{
	public static function create(?string $value = null): VegetableId
	{
		return new VegetableId($value ?? UuidMother::create());
	}
}
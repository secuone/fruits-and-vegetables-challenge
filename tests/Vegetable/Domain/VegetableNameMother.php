<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Vegetable\Domain;

use VeggieVibe\Vegetable\Domain\VegetableName;
use VeggieVibe\Tests\Shared\Domain\WordMother;

final class VegetableNameMother
{
	public static function create(?string $value = null): VegetableName
	{
		return new VegetableName($value ?? WordMother::create());
	}
}
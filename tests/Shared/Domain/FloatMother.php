<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Shared\Domain;

final class FloatMother
{
	public static function create(): float
	{
		return MotherCreator::random()->randomFloat(2, 0, 2000);
	}
}

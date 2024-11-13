<?php

declare(strict_types=1);

namespace VeggieVibe\Fruit\Application;

final class FruitsResponse
{
	private readonly array $fruits;

	public function __construct(FruitResponse ...$fruits)
	{
		$this->fruits = $fruits;
	}

	public function fruits(): array
	{
		return $this->fruits;
	}
}


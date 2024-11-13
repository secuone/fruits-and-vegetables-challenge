<?php

declare(strict_types=1);

namespace VeggieVibe\Vegetable\Application;

final class VegetablesResponse
{
	private readonly array $vegetables;

	public function __construct(VegetableResponse ...$vegetables)
	{
		$this->vegetables = $vegetables;
	}

	public function vegetables(): array
	{
		return $this->vegetables;
	}
}


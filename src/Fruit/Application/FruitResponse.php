<?php

declare(strict_types=1);

namespace VeggieVibe\Fruit\Application;

final readonly class FruitResponse
{
	public function __construct(private string $id, private string $name, private float $quantity, private string $unit) {}

	public function id(): string
	{
		return $this->id;
	}

	public function name(): string
	{
		return $this->name;
	}

	public function quantity(): float
	{
		return $this->quantity;
	}

    public function unit(): string
	{
		return $this->unit;
	}
}

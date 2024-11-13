<?php

declare(strict_types=1);

namespace VeggieVibe\Fruit\Domain;

use VeggieVibe\Shared\Domain\Item;
use VeggieVibe\Shared\Domain\ValueObject\WeightUnit;
use VeggieVibe\Fruit\Domain\FruitId;
use VeggieVibe\Fruit\Domain\FruitName;
use VeggieVibe\Fruit\Domain\FruitQuantity;

final class Fruit implements Item
{
    public function __construct(
        private readonly FruitId $id,
        private readonly FruitName $name,
        private readonly FruitQuantity $quantity
    ) {}

    public static function create(FruitId $id, FruitName $name, FruitQuantity $quantity): self
	{
		$course = new self($id, $name, $quantity);

		// Domain event goes here

		return $course;
	}

    public function id(): FruitId
    {
        return $this->id;
    }

    public function name(): FruitName
    {
        return $this->name;
    }

    public function quantity(): FruitQuantity
    {
        return $this->quantity;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id()->value(),
            'name' => $this->name()->value(),
            'quantity' => $this->quantity()->convertToGrams(),
            'unit' => WeightUnit::G
        ];
    }
}
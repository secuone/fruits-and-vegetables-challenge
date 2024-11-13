<?php

declare(strict_types=1);

namespace VeggieVibe\Vegetable\Domain;

use VeggieVibe\Shared\Domain\Item;
use VeggieVibe\Shared\Domain\ValueObject\WeightUnit;
use VeggieVibe\Vegetable\Domain\VegetableId;
use VeggieVibe\Vegetable\Domain\VegetableName;
use VeggieVibe\Vegetable\Domain\VegetableQuantity;

final class Vegetable implements Item
{
    public function __construct(
        private readonly VegetableId $id,
        private readonly VegetableName $name,
        private readonly VegetableQuantity $quantity
    ) {}

    public static function create(VegetableId $id, VegetableName $name, VegetableQuantity $quantity): self
	{
		$course = new self($id, $name, $quantity);

		// Domain event goes here

		return $course;
	}

    public function id(): VegetableId
    {
        return $this->id;
    }

    public function name(): VegetableName
    {
        return $this->name;
    }

    public function quantity(): VegetableQuantity
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
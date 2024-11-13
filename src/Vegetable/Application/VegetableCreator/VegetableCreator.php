<?php

declare(strict_types=1);

namespace VeggieVibe\Vegetable\Application\VegetableCreator;

use VeggieVibe\Vegetable\Domain\Vegetable;
use VeggieVibe\Vegetable\Domain\VegetableId;
use VeggieVibe\Vegetable\Domain\VegetableName;
use VeggieVibe\Vegetable\Domain\VegetableQuantity;
use VeggieVibe\Vegetable\Domain\VegetableRepository;

final readonly class VegetableCreator
{
	public function __construct(private VegetableRepository $repository) {}

	public function __invoke(VegetableId $id, VegetableName $name, VegetableQuantity $quantity): void
	{
		$vegetable = Vegetable::create($id, $name, $quantity);

		$this->repository->save($vegetable);
	}
}

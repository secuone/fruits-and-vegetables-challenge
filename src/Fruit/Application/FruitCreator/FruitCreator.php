<?php

declare(strict_types=1);

namespace VeggieVibe\Fruit\Application\FruitCreator;

use VeggieVibe\Fruit\Domain\Fruit;
use VeggieVibe\Fruit\Domain\FruitId;
use VeggieVibe\Fruit\Domain\FruitName;
use VeggieVibe\Fruit\Domain\FruitQuantity;
use VeggieVibe\Fruit\Domain\FruitRepository;

final readonly class FruitCreator
{
	public function __construct(private FruitRepository $repository) {}

	public function __invoke(FruitId $id, FruitName $name, FruitQuantity $quantity): void
	{
		$fruit = Fruit::create($id, $name, $quantity);

		$this->repository->save($fruit);
	}
}

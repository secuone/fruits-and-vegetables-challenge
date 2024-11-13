<?php

declare(strict_types=1);

namespace VeggieVibe\Fruit\Application\FruitFinder;

use VeggieVibe\Fruit\Domain\Fruit;
use VeggieVibe\Fruit\Domain\FruitId;
use VeggieVibe\Fruit\Domain\FruitNotFound;
use VeggieVibe\Fruit\Domain\FruitRepository;

final readonly class FruitFinder
{
	public function __construct(private FruitRepository $repository) {}

	public function __invoke(FruitId $id): Fruit
	{
		$fruit = $this->repository->find($id);

		if ($fruit === null) {
			throw new FruitNotFound($id);
		}

		return $fruit;
	}
}

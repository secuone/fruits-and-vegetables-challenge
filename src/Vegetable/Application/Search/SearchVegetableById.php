<?php

declare(strict_types=1);

namespace VeggieVibe\Vegetable\Application\Search;

use VeggieVibe\Vegetable\Domain\Vegetable;
use VeggieVibe\Vegetable\Domain\VegetableId;
use VeggieVibe\Vegetable\Domain\VegetableNotFound;
use VeggieVibe\Vegetable\Domain\VegetableRepository;

final readonly class SearchVegetableById
{
	public function __construct(private VegetableRepository $repository) {}

	public function __invoke(VegetableId $id): Vegetable
	{
		$vegetable = $this->repository->findById($id);

		if ($vegetable === null) {
			throw new VegetableNotFound($id);
		}

		return $vegetable;
	}
}

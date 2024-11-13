<?php

declare(strict_types=1);

namespace VeggieVibe\Vegetable\Application\Search;

use VeggieVibe\Vegetable\Application\VegetableResponse;
use VeggieVibe\Vegetable\Domain\VegetableId;
use VeggieVibe\Vegetable\Domain\VegetableRepository;

final readonly class SearchVegetableById
{
	public function __construct(private VegetableRepository $repository) {}

	public function __invoke(VegetableId $id): ?VegetableResponse
	{
		$vegetable = $this->repository->findById($id);

		if ($vegetable === null) {
			return null;
		}

		return new VegetableResponse(
			$vegetable->id()->value(),
			$vegetable->name()->value(),
			$vegetable->quantity()->value(),
			$vegetable->quantity()->unit()->value
		);
	}
}

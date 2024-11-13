<?php

declare(strict_types=1);

namespace VeggieVibe\Fruit\Application\Search;

use VeggieVibe\Fruit\Application\FruitResponse;
use VeggieVibe\Fruit\Domain\FruitId;
use VeggieVibe\Fruit\Domain\FruitRepository;

final readonly class SearchFruitById
{
	public function __construct(private FruitRepository $repository) {}

	public function __invoke(FruitId $id): ?FruitResponse
	{
		$fruit = $this->repository->findById($id);

		if ($fruit === null) {
			return null;
		}

		return new FruitResponse(
			$fruit->id()->value(),
			$fruit->name()->value(),
			$fruit->quantity()->value(),
			$fruit->quantity()->unit()->value
		);
	}
}

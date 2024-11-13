<?php

declare(strict_types=1);

namespace VeggieVibe\Fruit\Application\SearchAll;

use VeggieVibe\Fruit\Application\FruitResponse;
use VeggieVibe\Fruit\Application\FruitsResponse;
use VeggieVibe\Fruit\Domain\Fruit;
use VeggieVibe\Fruit\Domain\FruitRepository;

final readonly class SearchAllFruits
{
	public function __construct(private FruitRepository $repository) {}

	public function __invoke(): ?FruitsResponse
	{
		$fruits = $this->repository->findAll();

		if (!$fruits) {
			return null;
		}

		$fruitsResponses = array_map(fn (Fruit $fruit) => $this->toResponse($fruit), $fruits->items());
		return new FruitsResponse(...$fruitsResponses);
	}

	private function toResponse(Fruit $fruit): FruitResponse
	{
		return new FruitResponse(
            $fruit->id()->value(),
			$fruit->name()->value(),
			$fruit->quantity()->value(),
			$fruit->quantity()->unit()->value
        );
	}
}

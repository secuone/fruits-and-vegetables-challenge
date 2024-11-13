<?php

declare(strict_types=1);

namespace VeggieVibe\Vegetable\Application\SearchAll;

use VeggieVibe\Vegetable\Application\VegetableResponse;
use VeggieVibe\Vegetable\Application\VegetablesResponse;
use VeggieVibe\Vegetable\Domain\Vegetable;
use VeggieVibe\Vegetable\Domain\VegetableRepository;

final readonly class SearchAllVegetables
{
	public function __construct(private VegetableRepository $repository) {}

	public function __invoke(): ?VegetablesResponse
	{
		$vegetables = $this->repository->findAll();

		if (!$vegetables) {
			return null;
		}

		$vegetablesResponses = array_map(fn (Vegetable $vegetable) => $this->toResponse($vegetable), $vegetables->items());
		return new VegetablesResponse(...$vegetablesResponses);
	}

	private function toResponse(Vegetable $vegetable): VegetableResponse
	{
		return new VegetableResponse(
            $vegetable->id()->value(),
			$vegetable->name()->value(),
			$vegetable->quantity()->value(),
			$vegetable->quantity()->unit()->value
        );
	}
}

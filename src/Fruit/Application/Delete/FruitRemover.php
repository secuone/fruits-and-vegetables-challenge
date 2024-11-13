<?php

declare(strict_types=1);

namespace VeggieVibe\Fruit\Application\Delete;

use VeggieVibe\Fruit\Domain\FruitId;
use VeggieVibe\Fruit\Domain\FruitRepository;

final readonly class FruitRemover
{
	public function __construct(private FruitRepository $repository) {}

	public function __invoke(FruitId $id): void
	{
		$this->repository->delete($id);
	}
}

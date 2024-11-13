<?php

declare(strict_types=1);

namespace VeggieVibe\Vegetable\Application\VegetableDeletion;

use VeggieVibe\Vegetable\Domain\VegetableId;
use VeggieVibe\Vegetable\Domain\VegetableRepository;

final readonly class VegetableDeletion
{
	public function __construct(private VegetableRepository $repository) {}

	public function __invoke(VegetableId $id): void
	{
		$this->repository->delete($id);
	}
}

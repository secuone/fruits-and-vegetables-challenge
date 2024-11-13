<?php

declare(strict_types=1);

namespace VeggieVibe\Fruit\Domain;

use VeggieVibe\Shared\Domain\DomainError;

final class FruitNotFound extends DomainError
{
	public function __construct(private readonly FruitId $id)
	{
		parent::__construct();
	}

	public function errorCode(): string
	{
		return 'FRUIT_NOT_FOUND';
	}

	protected function errorMessage(): string
	{
		return sprintf('Fruit not found for the given ID: $s', $this->id->value());
	}
}

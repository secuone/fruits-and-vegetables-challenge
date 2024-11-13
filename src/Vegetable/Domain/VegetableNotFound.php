<?php

declare(strict_types=1);

namespace VeggieVibe\Vegetable\Domain;

use VeggieVibe\Shared\Domain\DomainError;

final class VegetableNotFound extends DomainError
{
	public function __construct(private readonly VegetableId $id)
	{
		parent::__construct();
	}

	public function errorCode(): string
	{
		return 'VEGETABLE_NOT_FOUND';
	}

	protected function errorMessage(): string
	{
		return sprintf('Vegetable not found for the given ID: $s', $this->id->value());
	}
}

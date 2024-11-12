<?php

declare(strict_types=1);

namespace VeggieVibe\Shared\Domain\ValueObject;

use VeggieVibe\Shared\Domain\Uuid as UuidInterface;

abstract class Uuid implements UuidInterface
{
	final public function __construct(protected string $value) {}

	final public function value(): string
	{
		return $this->value;
	}

	final public function equals(UuidInterface $other): bool
	{
		return $this->value() === $other->value();
	}

	public function __toString(): string
	{
		return $this->value();
	}
}
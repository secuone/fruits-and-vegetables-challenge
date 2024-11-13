<?php

declare(strict_types=1);

namespace VeggieVibe\Shared\Infrastructure\Symfony;

use VeggieVibe\Shared\Domain\UuidGenerator;
use Symfony\Component\Uid\Uuid;

final class SymfonyUuidGenerator implements UuidGenerator
{
	public function generate(): string
	{
		return Uuid::v4()->toRfc4122();
	}
}
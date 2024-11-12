<?php

declare(strict_types=1);

namespace VeggieVibe\Shared\Infrastructure\Symfony;

use VeggieVibe\Shared\Domain\UuidGenerator;
use Symfony\Component\Uid\Uuid as SymfonyUuid;

final class SymfonyUuidGenerator implements UuidGenerator
{
	public function generate(): string
	{
		return SymfonyUuid::v4()->toRfc4122();
	}
}
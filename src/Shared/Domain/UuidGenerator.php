<?php

declare(strict_types=1);

namespace VeggieVibe\Shared\Domain;

interface UuidGenerator
{
	public function generate(): string;
}
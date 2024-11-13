<?php

declare(strict_types=1);

namespace VeggieVibe\Shared\Infrastructure\Persistence\Redis;

use Redis;

abstract class RedisRepository
{
	public function __construct(private readonly Redis $client) {}

    protected function persist() {
        return true;
    }

    protected function remove() {
        return true;
    }

    protected function find() {
        return true;
    }
}
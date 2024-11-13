<?php

declare(strict_types=1);

namespace VeggieVibe\Shared\Infrastructure\Persistence\Redis;

use Redis;
use VeggieVibe\Shared\Domain\Item;
use VeggieVibe\Shared\Domain\Uuid;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

abstract class RedisRepository
{
	public function __construct(
        private readonly Redis $client,
        private readonly NormalizerInterface $serializer
    ) {}

    protected function persist(Item $item): void
    {
        $this->client->hSet(
            static::PREFIX->value,
            $item->id()->value(),
            $this->serializer->serialize($item, 'json')
        );
    }

    protected function searchById(Uuid $uuid): ?Item
    {
        return null;
    }

    protected function remove(Uuid $uuid): void
    {
        $this->client->hDel(
            static::PREFIX->value,
            $uuid->value()
        );
    }

    protected function flushAll(): void
    {
        $this->client->del(static::PREFIX->value);
    }
}
<?php

declare(strict_types=1);

namespace VeggieVibe\Shared\Infrastructure\Persistence\Redis;

use Redis;
use VeggieVibe\Shared\Domain\Item;
use VeggieVibe\Shared\Domain\Uuid;
use VeggieVibe\Shared\Domain\PrimitiveItem;
use VeggieVibe\Shared\Domain\ValueObject\ItemType;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

abstract class RedisRepository
{
	public function __construct(
        private readonly Redis $client,
        private readonly SerializerInterface $serializer,
        protected readonly DenormalizerInterface $denormalizer
    ) {}

    protected function persist(Item $item): void
    {
        $this->client->hSet(
            static::PREFIX->value,
            $item->id()->value(),
            $this->serializer->serialize($item, 'json')
        );
    }

    protected function searchById(Uuid $uuid, ItemType $itemType)
    {
        $jsonData = $this->client->hGet(
            static::PREFIX->value,
            $uuid->value()
        );

        if ($jsonData === null) {
            return null;
        }

        $primitiveItem = $this->serializer->deserialize($jsonData, PrimitiveItem::class, 'json');

        return $this->denormalizer->denormalize($primitiveItem, $itemType->class());
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
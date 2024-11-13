<?php

declare(strict_types=1);

namespace VeggieVibe\Fruit\Infrastructure\Persistence\Redis;

use VeggieVibe\Fruit\Domain\Fruit;
use VeggieVibe\Fruit\Domain\Fruits;
use VeggieVibe\Fruit\Domain\FruitId;
use VeggieVibe\Fruit\Domain\FruitRepository;
use VeggieVibe\Shared\Domain\ValueObject\ItemType;
use VeggieVibe\Shared\Infrastructure\Persistence\Redis\RedisRepository;


final class RedisFruitRepository extends RedisRepository implements FruitRepository
{
    protected const PREFIX = ItemType::FRUIT;

    public function save(Fruit $item): void
    {
        $this->persist($item);
    }

    public function findById(FruitId $id): ?Fruit
    {
        return $this->searchById($id, ItemType::FRUIT);
    }

    public function findAll(): ?Fruits
    {
       $result = $this->searchAll(ItemType::FRUIT);

        if (!$result) {
            return null;
        };

        return new Fruits($result);
    }

    public function delete(FruitId $id): void
    {
        $this->remove($id);
    }

    public function deleteAll(): void
    {
        $this->flushAll();
    }
}
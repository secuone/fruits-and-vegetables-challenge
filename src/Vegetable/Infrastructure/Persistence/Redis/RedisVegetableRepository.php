<?php

declare(strict_types=1);

namespace VeggieVibe\Vegetable\Infrastructure\Persistence\Redis;

use VeggieVibe\Vegetable\Domain\Vegetable;
use VeggieVibe\Vegetable\Domain\VegetableId;
use VeggieVibe\Vegetable\Domain\VegetableRepository;
use VeggieVibe\Shared\Domain\ValueObject\ItemType;
use VeggieVibe\Shared\Infrastructure\Persistence\Redis\RedisRepository;
use VeggieVibe\Vegetable\Domain\Vegetables;

final class RedisVegetableRepository extends RedisRepository implements VegetableRepository
{
    protected const PREFIX = ItemType::VEGETABLE;

    public function save(Vegetable $item): void
    {
        $this->persist($item);
    }

    public function findById(VegetableId $id): ?Vegetable
    {
        return $this->searchById($id, ItemType::VEGETABLE);
    }

    public function findAll(): ?Vegetables
    {
       $result = $this->searchAll(ItemType::FRUIT);

        if (!$result) {
            return null;
        };

        return new Vegetables($result);
    }

    public function delete(VegetableId $id): void
    {
        $this->remove($id);
    }

    public function deleteAll(): void
    {
        $this->flushAll();
    }
}
<?php

declare(strict_types=1);

namespace VeggieVibe\Vegetable\Infrastructure\Persistence\Redis;

use VeggieVibe\Shared\Domain\ValueObject\ItemType;
use VeggieVibe\Vegetable\Domain\Vegetable;
use VeggieVibe\Vegetable\Domain\VegetableId;
use VeggieVibe\Vegetable\Domain\VegetableRepository;
use VeggieVibe\Shared\Infrastructure\Persistence\Redis\RedisRepository;

final class RedisVegetableRepository extends RedisRepository implements VegetableRepository
{
    protected const PREFIX = ItemType::VEGETABLE;

    public function save(Vegetable $item): void
    {
        $this->persist($item);
    }

    public function findById(VegetableId $id): ?Vegetable
    {
        return $this->toVegetable($this->searchById($id));
    }

    public function delete(VegetableId $id): void
    {
        $this->remove($id);
    }

    private function toVegetable($data) {
        return $data;
    }

    public function deleteAll(): void
    {
        $this->flushAll();
    }
}
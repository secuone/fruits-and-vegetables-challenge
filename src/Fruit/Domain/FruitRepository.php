<?php

declare(strict_types=1);

namespace VeggieVibe\Fruit\Domain;

interface FruitRepository
{
    public function save(Fruit $fruit): void;
    public function findById(FruitId $id): ?Fruit;
    public function findAll(): ?Fruits;
    public function delete(FruitId $id): void;
    public function deleteAll(): void;
}
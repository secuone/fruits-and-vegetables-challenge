<?php

declare(strict_types=1);

namespace VeggieVibe\Fruit\Domain;

interface FruitRepository
{
    public function persist(Fruit $fruit): void;
    public function find(FruitId $id): ?Fruit;
    public function delete(FruitId $id): void;
}
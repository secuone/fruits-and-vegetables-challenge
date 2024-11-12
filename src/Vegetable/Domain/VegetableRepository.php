<?php

declare(strict_types=1);

namespace VeggieVibe\Vegetable\Domain;

interface VegetableRepository
{
    public function persist(Vegetable $vegetable): void;
    public function find(VegetableId $id): ?Vegetable;
    public function delete(VegetableId $id): void;
}
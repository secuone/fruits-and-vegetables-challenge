<?php

declare(strict_types=1);

namespace VeggieVibe\Vegetable\Domain;

interface VegetableRepository
{
    public function save(Vegetable $vegetable): void;
    public function findById(VegetableId $id): ?Vegetable;
    public function delete(VegetableId $id): void;
}
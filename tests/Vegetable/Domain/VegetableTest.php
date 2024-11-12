<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Vegetable\Domain;

use PHPUnit\Framework\TestCase;
use VeggieVibe\Shared\Domain\ValueObject\WeightUnit;
use VeggieVibe\Tests\Vegetable\Domain\VegetableMother;
use VeggieVibe\Tests\Shared\Domain\UuidMother;

class VegetableTest extends TestCase
{
    /** @test */
    public function it_should_return_correct_id(): void
    {
        $uuid = UuidMother::create();
        $id = VegetableIdMother::create($uuid);
        $fruit = VegetableMother::create($id);

        $this->assertSame($id, $fruit->id());
        $this->assertSame($uuid, $fruit->id()->value());
    }

    /** @test */
    public function it_should_return_correct_name(): void
    {
        $name = VegetableNameMother::create();
        $fruit = VegetableMother::create(null, $name);

        $this->assertSame($name, $fruit->name());
        $this->assertSame($name->value(), $fruit->name()->value());
    }

    /** @test */
    public function it_should_return_correct_quantity(): void
    {
        $quantity = VegetableQuantityMother::create();
        $fruit = VegetableMother::create(null, null, $quantity);

        $this->assertSame($quantity, $fruit->quantity());
        $this->assertSame($quantity->value(), $fruit->quantity()->value());
    }

    /** @test */
    public function it_should_convert_to_array_correctly(): void
    {
        $id = VegetableIdMother::create();
        $name = VegetableNameMother::create();
        $quantity = VegetableQuantityMother::create();
        $fruit = VegetableMother::create($id, $name, $quantity);

        $expectedArray = [
            'id' => $id->value(),
            'name' => $name->value(),
            'quantity' => $quantity->convertToGrams(),
            'unit' => WeightUnit::G
        ];
    
        $this->assertSame($expectedArray, $fruit->toArray());
    }
}
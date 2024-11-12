<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Fruit\Domain;

use PHPUnit\Framework\TestCase;
use VeggieVibe\Shared\Domain\ValueObject\WeightUnit;
use VeggieVibe\Tests\Fruit\Domain\FruitMother;
use VeggieVibe\Tests\Shared\Domain\UuidMother;

class FruitTest extends TestCase
{
    /** @test */
    public function it_should_return_correct_id(): void
    {
        $uuid = UuidMother::create();
        $id = FruitIdMother::create($uuid);
        $fruit = FruitMother::create($id);

        $this->assertSame($id, $fruit->id());
        $this->assertSame($uuid, $fruit->id()->value());
    }

    /** @test */
    public function it_should_return_correct_name(): void
    {
        $name = FruitNameMother::create();
        $fruit = FruitMother::create(null, $name);

        $this->assertSame($name, $fruit->name());
        $this->assertSame($name->value(), $fruit->name()->value());
    }

    /** @test */
    public function it_should_return_correct_quantity(): void
    {
        $quantity = FruitQuantityMother::create();
        $fruit = FruitMother::create(null, null, $quantity);

        $this->assertSame($quantity, $fruit->quantity());
        $this->assertSame($quantity->value(), $fruit->quantity()->value());
    }

    /** @test */
    public function it_should_convert_to_array_correctly(): void
    {
        $id = FruitIdMother::create();
        $name = FruitNameMother::create();
        $quantity = FruitQuantityMother::create();
        $fruit = FruitMother::create($id, $name, $quantity);

        $expectedArray = [
            'id' => $id->value(),
            'name' => $name->value(),
            'quantity' => $quantity->convertToGrams(),
            'unit' => WeightUnit::G
        ];
    
        $this->assertSame($expectedArray, $fruit->toArray());
    }
}
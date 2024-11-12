<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Fruit\Domain;

use PHPUnit\Framework\TestCase;
use VeggieVibe\Tests\Fruit\Domain\FruitIdMother;
use VeggieVibe\Tests\Shared\Domain\UuidMother;

class FruitIdTest extends TestCase
{
    /** @test */
    public function it_should_return_value(): void
    {
        $fruitId = FruitIdMother::create();

        $this->assertNotEmpty($fruitId->value());
        $this->assertIsString($fruitId->value());
    }

    /** @test */
    public function it_should_return_value_correctly(): void
    {
        $uuid = UuidMother::create();
        $fruitId = FruitIdMother::create($uuid);

        $this->assertIsString($fruitId->value());
        $this->assertSame($uuid, $fruitId->value());
    }

    /** @test */
    public function it_should_be_different_from_other(): void
    {
        $fruitId = FruitIdMother::create();
        $otherFruitId = FruitIdMother::create();

        $this->assertNotEmpty($fruitId->value());
        $this->assertNotEmpty($otherFruitId->value());
        $this->assertNotSame($otherFruitId->value(), $fruitId->value());
    }

     /** @test */
     public function it_should_be_the_same(): void
     {
        $uuid = UuidMother::create();
        $fruitId = FruitIdMother::create($uuid);
        $otherFruitId = FruitIdMother::create($uuid);

        $this->assertNotEmpty($fruitId->value());
        $this->assertNotEmpty($otherFruitId->value());
        $this->assertSame($otherFruitId->value(), $fruitId->value());
     }
}
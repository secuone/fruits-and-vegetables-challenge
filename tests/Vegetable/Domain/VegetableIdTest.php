<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Vegetable\Domain;

use PHPUnit\Framework\TestCase;
use VeggieVibe\Tests\Vegetable\Domain\VegetableIdMother;
use VeggieVibe\Tests\Shared\Domain\UuidMother;

class VegetableIdTest extends TestCase
{
    /** @test */
    public function it_should_return_value(): void
    {
        $vegetableId = VegetableIdMother::create();

        $this->assertNotEmpty($vegetableId->value());
        $this->assertIsString($vegetableId->value());
    }

    /** @test */
    public function it_should_return_value_correctly(): void
    {
        $uuid = UuidMother::create();
        $vegetableId = VegetableIdMother::create($uuid);

        $this->assertIsString($vegetableId->value());
        $this->assertSame($uuid, $vegetableId->value());
    }

    /** @test */
    public function it_should_be_different_from_other(): void
    {
        $vegetableId = VegetableIdMother::create();
        $otherVegetableId = VegetableIdMother::create();

        $this->assertNotEmpty($vegetableId->value());
        $this->assertNotEmpty($otherVegetableId->value());
        $this->assertNotSame($otherVegetableId->value(), $vegetableId->value());
    }

     /** @test */
     public function it_should_be_the_same(): void
     {
        $uuid = UuidMother::create();
        $vegetableId = VegetableIdMother::create($uuid);
        $otherVegetableId = VegetableIdMother::create($uuid);

        $this->assertNotEmpty($vegetableId->value());
        $this->assertNotEmpty($otherVegetableId->value());
        $this->assertSame($otherVegetableId->value(), $vegetableId->value());
     }
}
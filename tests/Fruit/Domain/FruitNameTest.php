<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Fruit\Domain;

use PHPUnit\Framework\TestCase;
use VeggieVibe\Tests\Fruit\Domain\FruitNameMother;

class FruitNameTest extends TestCase
{
    /** @test */
    public function it_should_return_value(): void
    {
        $name = FruitNameMother::create();

        $this->assertNotEmpty($name->value());
        $this->assertIsString($name->value());
    }

    /** @test */
    public function it_should_return_value_correctly(): void
    {
        $value = 'test';
        $name = FruitNameMother::create($value);

        $this->assertIsString($name->value());
        $this->assertSame($value, $name->value());
    }
}
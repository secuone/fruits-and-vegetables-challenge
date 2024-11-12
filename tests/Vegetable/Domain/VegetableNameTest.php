<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Vegetable\Domain;

use PHPUnit\Framework\TestCase;
use VeggieVibe\Tests\Vegetable\Domain\VegetableNameMother;

class VegetableNameTest extends TestCase
{
    /** @test */
    public function it_should_return_value(): void
    {
        $name = VegetableNameMother::create();

        $this->assertNotEmpty($name->value());
        $this->assertIsString($name->value());
    }

    /** @test */
    public function it_should_return_value_correctly(): void
    {
        $value = 'test';
        $name = VegetableNameMother::create($value);

        $this->assertIsString($name->value());
        $this->assertSame($value, $name->value());
    }
}
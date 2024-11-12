<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Vegetable\Domain;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use VeggieVibe\Shared\Domain\ValueObject\WeightUnit;
use VeggieVibe\Tests\Vegetable\Domain\VegetableQuantityMother;

class VegetableQuantityTest extends TestCase
{
    /** @test */
    public function it_should_throw_exception_for_negative_value(): void
    {
        $this->expectException(InvalidArgumentException::class);
        VegetableQuantityMother::create(-1);
    }

    /** @test */
    public function it_should_return_value_correctly(): void
    {
        $quantity = VegetableQuantityMother::create();

        $this->assertIsFloat($quantity->value());
    }

    /** @test */
    public function it_should_return_unit_correctly(): void
    {
        $quantity = VegetableQuantityMother::create();

        $this->assertSame(WeightUnit::G, $quantity->unit());
    }

    /** @test */
    public function it_should_convert_from_kg_to_grams_correctly(): void
    {
        $value = 2.00;
        $valueInGrams = 2000.00;
        $quantity = VegetableQuantityMother::create($value, WeightUnit::KG);

        $this->assertSame($value, $quantity->value());
        $this->assertSame(WeightUnit::KG, $quantity->unit());
        $this->assertSame($valueInGrams, $quantity->convertToGrams());
    }

    /** @test */
    public function it_should_convert_from_grams_to_grams_correctly(): void
    {
        $value = 2.00;
        $quantity = VegetableQuantityMother::create($value, WeightUnit::G);

        $this->assertSame($value, $quantity->convertToGrams());
    }

    /** @test */
    public function it_should_return_true_for_equal_weights(): void
    {
        $value = 2.00;
        $quantity = VegetableQuantityMother::create($value, WeightUnit::KG);
        $otherQuantity = VegetableQuantityMother::create($value, WeightUnit::KG);

        $this->assertTrue($quantity->equals($otherQuantity));
    }

    /** @test */
    public function it_should_return_true_for_equal_weights_in_different_units(): void
    {
        $value = 2.00;
        $valueInGrams = 2000.00;
        $quantity = VegetableQuantityMother::create($value, WeightUnit::KG);
        $otherQuantity = VegetableQuantityMother::create($valueInGrams, WeightUnit::G);

        $this->assertTrue($quantity->equals($otherQuantity));
    }

    /** @test */
    public function it_should_return_false_for_different_weights(): void
    {
        $quantity = VegetableQuantityMother::create(2, WeightUnit::KG);
        $otherQuantity = VegetableQuantityMother::create(3, WeightUnit::KG);

        $this->assertFalse($quantity->equals($otherQuantity));
    }

    /** @test */
    public function it_should_return_false_for_different_weights_in_different_units(): void
    {
        $quantity = VegetableQuantityMother::create(2, WeightUnit::KG);
        $otherQuantity = VegetableQuantityMother::create(3000, WeightUnit::G);

        $this->assertFalse($quantity->equals($otherQuantity));
    }
}
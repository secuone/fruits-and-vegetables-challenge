<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Shared\Domain;

use PHPUnit\Framework\TestCase;
use VeggieVibe\Shared\Domain\ValueObject\WeightUnit;

class WeightUnitTest extends TestCase
{
    /** @test */
    public function it_should_return_1_for_base_unit_grams(): void
    {
        $unit = WeightUnit::G;

        $this->assertIsFloat($unit->toBaseUnit());
        $this->assertSame(1.0, $unit->toBaseUnit());
    }

    public function it_should_return_1000_for_base_unit_kilograms(): void
    {
        $unit = WeightUnit::KG;

        $this->assertIsFloat($unit->toBaseUnit());
        $this->assertSame(1000.0, $unit->toBaseUnit());
    }
}
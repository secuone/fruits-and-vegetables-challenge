<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Vegetable\Infrastructure;

use stdClass;
use PHPUnit\Framework\TestCase;
use VeggieVibe\Vegetable\Domain\Vegetable;
use VeggieVibe\Tests\Vegetable\Domain\VegetableMother;
use VeggieVibe\Vegetable\Infrastructure\Serializer\VegetableNormalizer;

final class VegetableNormalizerTest extends TestCase
{
    private readonly VegetableNormalizer $normalizer;

    public function setUp(): void
    {
        $this->normalizer = new VegetableNormalizer;
    }

	/** @test */
	public function it_should_return_an_array(): void
	{
		$item = VegetableMother::create();

		$normalized = $this->normalizer->normalize($item);

        $this->assertIsArray($normalized);
	}

    /** @test */
	public function it_should_return_normalized_data_for_valid_vegetable(): void
	{
		$item = VegetableMother::create();

		$normalized = $this->normalizer->normalize($item);

        $this->assertSame($item->toArray(), $normalized);
	}

    /** @test */
	public function it_should_return_false_for_non_vegetable_object_in_supportsNormalization(): void
	{
		$item = new stdClass;

        $this->assertFalse($this->normalizer->supportsNormalization($item));
	}

    /** @test */
    public function it_should_return_true_for_vegetable_object_in_supportsNormalization(): void
    {
        $item = VegetableMother::create();

        $this->assertTrue($this->normalizer->supportsNormalization($item));
    }

    /** @test */
    public function it_should_return_supported_types(): void
    {
        $supportedTypes = $this->normalizer->getSupportedTypes(null);

        $this->assertArrayHasKey(Vegetable::class, $supportedTypes);
        $this->assertTrue($supportedTypes[Vegetable::class]);
    }
}
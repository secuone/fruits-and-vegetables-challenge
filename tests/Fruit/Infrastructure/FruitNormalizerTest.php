<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Fruit\Infrastructure;

use stdClass;
use PHPUnit\Framework\TestCase;
use VeggieVibe\Fruit\Domain\Fruit;
use VeggieVibe\Tests\Fruit\Domain\FruitMother;
use VeggieVibe\Fruit\Infrastructure\Serializer\FruitNormalizer;

final class FruitNormalizerTest extends TestCase
{
    private readonly FruitNormalizer $normalizer;

    public function setUp(): void
    {
        $this->normalizer = new FruitNormalizer;
    }

	/** @test */
	public function it_should_return_an_array(): void
	{
		$item = FruitMother::create();

		$normalized = $this->normalizer->normalize($item);

        $this->assertIsArray($normalized);
	}

    /** @test */
	public function it_should_return_normalized_data_for_valid_fruit(): void
	{
		$item = FruitMother::create();

		$normalized = $this->normalizer->normalize($item);

        $this->assertSame($item->toArray(), $normalized);
	}

    /** @test */
	public function it_should_return_false_for_non_fruit_object_in_supportsNormalization(): void
	{
		$item = new stdClass;

        $this->assertFalse($this->normalizer->supportsNormalization($item));
	}

    /** @test */
    public function it_should_return_true_for_fruit_object_in_supportsNormalization(): void
    {
        $item = FruitMother::create();

        $this->assertTrue($this->normalizer->supportsNormalization($item));
    }

    /** @test */
    public function it_should_return_supported_types(): void
    {
        $supportedTypes = $this->normalizer->getSupportedTypes(null);

        $this->assertArrayHasKey(Fruit::class, $supportedTypes);
        $this->assertTrue($supportedTypes[Fruit::class]);
    }
}
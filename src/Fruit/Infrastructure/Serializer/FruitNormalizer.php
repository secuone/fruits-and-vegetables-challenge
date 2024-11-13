<?php

namespace VeggieVibe\Fruit\Infrastructure\Serializer;

use VeggieVibe\Fruit\Domain\Fruit;
use VeggieVibe\Shared\Domain\ValueObject\WeightUnit;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class FruitNormalizer implements NormalizerInterface
{
    final public function __construct() {}

    public function normalize($object, ?string $format = null, array $context = []): array
    {
        return [
            'id' => $object->id()->value(),
            'name' => $object->name()->value(),
            'quantity' => $object->quantity()->convertToGrams(),
            'unit' => WeightUnit::G
        ];
    }

    public function supportsNormalization($data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof Fruit;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [Fruit::class => true];
    }
}
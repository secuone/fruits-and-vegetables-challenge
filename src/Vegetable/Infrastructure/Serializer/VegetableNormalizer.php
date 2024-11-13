<?php

namespace VeggieVibe\Vegetable\Infrastructure\Serializer;

use VeggieVibe\Vegetable\Domain\Vegetable;
use VeggieVibe\Shared\Domain\ValueObject\WeightUnit;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class VegetableNormalizer implements NormalizerInterface
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
        return $data instanceof Vegetable;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [Vegetable::class => true];
    }
}
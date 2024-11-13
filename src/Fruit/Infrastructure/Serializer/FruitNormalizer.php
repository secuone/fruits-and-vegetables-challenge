<?php

namespace VeggieVibe\Fruit\Infrastructure\Serializer;

use VeggieVibe\Fruit\Domain\Fruit;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class FruitNormalizer implements NormalizerInterface
{
    final public function __construct() {}

    public function normalize($object, ?string $format = null, array $context = []): array
    {
        return $object->toArray();
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
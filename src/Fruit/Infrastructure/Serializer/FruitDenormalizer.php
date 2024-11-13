<?php

namespace VeggieVibe\Fruit\Infrastructure\Serializer;

use VeggieVibe\Fruit\Domain\Fruit;
use VeggieVibe\Fruit\Domain\FruitId;
use VeggieVibe\Fruit\Domain\FruitName;
use VeggieVibe\Fruit\Domain\FruitQuantity;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use VeggieVibe\Shared\Domain\ValueObject\WeightUnit;
use VeggieVibe\Shared\Infrastructure\Symfony\SymfonyUuidGenerator;

class FruitDenormalizer implements DenormalizerInterface
{
    final public function __construct() {}

    public function denormalize($data, string $type, ?string $format = null, array $context = []): Fruit
    {

        return new Fruit(
            new FruitId((new SymfonyUuidGenerator)->generate()),
            new FruitName($data['name']),
            new FruitQuantity((float) $data['quantity'], WeightUnit::from($data['unit']))
        );
    }

    public function supportsDenormalization($data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === Fruit::class;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [Fruit::class => true];
    }
}
<?php

namespace VeggieVibe\Vegetable\Infrastructure\Serializer;

use VeggieVibe\Vegetable\Domain\Vegetable;
use VeggieVibe\Vegetable\Domain\VegetableId;
use VeggieVibe\Vegetable\Domain\VegetableName;
use VeggieVibe\Vegetable\Domain\VegetableQuantity;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use VeggieVibe\Shared\Domain\ValueObject\WeightUnit;
use VeggieVibe\Shared\Infrastructure\Symfony\SymfonyUuidGenerator;

class VegetableDenormalizer implements DenormalizerInterface
{
    final public function __construct() {}

    public function denormalize($data, string $type, ?string $format = null, array $context = []): Vegetable
    {

        return new Vegetable(
            new VegetableId((new SymfonyUuidGenerator)->generate()),
            new VegetableName($data['name']),
            new VegetableQuantity((float) $data['quantity'], WeightUnit::from($data['unit']))
        );
    }

    public function supportsDenormalization($data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === Vegetable::class;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [Vegetable::class => true];
    }
}
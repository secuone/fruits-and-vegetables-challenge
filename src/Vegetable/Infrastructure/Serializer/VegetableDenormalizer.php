<?php

namespace VeggieVibe\Vegetable\Infrastructure\Serializer;

use InvalidArgumentException;
use VeggieVibe\Vegetable\Domain\Vegetable;
use VeggieVibe\Vegetable\Domain\VegetableId;
use VeggieVibe\Vegetable\Domain\VegetableName;
use VeggieVibe\Vegetable\Domain\VegetableQuantity;
use VeggieVibe\Shared\Domain\PrimitiveItem;
use VeggieVibe\Shared\Domain\UuidGenerator;
use VeggieVibe\Shared\Domain\ValueObject\WeightUnit;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class VegetableDenormalizer implements DenormalizerInterface
{
    final public function __construct(private readonly UuidGenerator $uuidGenerator) {}

    public function denormalize($data, string $type, ?string $format = null, array $context = []): Vegetable
    {
        if (!$data instanceof PrimitiveItem) {
            throw new InvalidArgumentException('Parameter is not of type PrimitiveItem');
        }

        return new Vegetable(
            new VegetableId($this->uuidGenerator->generate()),
            new VegetableName($data->name()),
            new VegetableQuantity($data->quantity(), WeightUnit::from($data->unit()))
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
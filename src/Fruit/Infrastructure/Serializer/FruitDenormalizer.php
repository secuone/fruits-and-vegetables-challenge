<?php

namespace VeggieVibe\Fruit\Infrastructure\Serializer;

use InvalidArgumentException;
use VeggieVibe\Fruit\Domain\Fruit;
use VeggieVibe\Fruit\Domain\FruitId;
use VeggieVibe\Fruit\Domain\FruitName;
use VeggieVibe\Fruit\Domain\FruitQuantity;
use VeggieVibe\Shared\Domain\PrimitiveItem;
use VeggieVibe\Shared\Domain\UuidGenerator;
use VeggieVibe\Shared\Domain\ValueObject\WeightUnit;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class FruitDenormalizer implements DenormalizerInterface
{
    final public function __construct(private readonly UuidGenerator $uuidGenerator) {}

    public function denormalize($data, string $type, ?string $format = null, array $context = []): Fruit
    {
        if (!$data instanceof PrimitiveItem) {
            throw new InvalidArgumentException('Parameter is not of type PrimitiveItem');
        }

        return new Fruit(
            new FruitId($this->uuidGenerator->generate()),
            new FruitName($data->name()),
            new FruitQuantity($data->quantity(), WeightUnit::from($data->unit()))
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
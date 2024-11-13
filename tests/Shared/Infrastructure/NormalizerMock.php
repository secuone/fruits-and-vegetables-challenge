<?php

declare(strict_types=1);

namespace VeggieVibe\Tests\Shared\Infrastructure;

use ArrayObject;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class NormalizerMock implements NormalizerInterface, SerializerInterface
{
    public function serialize(mixed $data, string $format, array $context = []): string
    {
        return '{}';        
    }

    public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|ArrayObject|null
    {
        return true;
    }

    public function deserialize(mixed $data, string $type, string $format, array $context = []): mixed
    {
        return true;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return true;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [];
    }
}
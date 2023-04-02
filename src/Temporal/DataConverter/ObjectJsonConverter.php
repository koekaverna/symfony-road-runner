<?php

declare(strict_types=1);

namespace App\Temporal\DataConverter;

use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Temporal\Api\Common\V1\Payload;
use Temporal\DataConverter\Converter;
use Temporal\DataConverter\Type;
use Temporal\Exception\DataConverterException;

final class ObjectJsonConverter extends Converter
{
    public function __construct(
        private readonly SerializerInterface $serializer,
    ) {
    }

    public function getEncodingType(): string
    {
        return 'json/object';
    }

    /**
     * @param mixed $value
     */
    public function toPayload($value): ?Payload
    {
        if (!\is_object($value)) {
            return null;
        }

        return $this->create($this->serializer->serialize($value, 'json'));
    }

    public function fromPayload(Payload $payload, Type $type): object
    {
        if (!$type->isClass()) {
            throw new DataConverterException('Unable to decode value using protobuf converter - ');
        }

        try {
            return $this->serializer->deserialize($payload->getData(), $type->getName(), 'json');
        } catch (ExceptionInterface $e) {
            throw new DataConverterException($e->getMessage(), $e->getCode(), $e);
        }
    }
}

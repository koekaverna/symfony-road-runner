<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Temporal\DataConverter\ObjectJsonConverter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;
use Temporal\Api\Common\V1\Payload;
use Temporal\DataConverter\Type;

final class ObjectJsonConverterTest extends TestCase
{
    private ObjectJsonConverter $converter;

    protected function setUp(): void
    {
        $serializer = new Serializer([new PropertyNormalizer()], [new JsonEncoder()]);
        $this->converter = new ObjectJsonConverter(
            $serializer,
        );
    }

    public function testToPayload(): void
    {
        $object = new TestClass('test');
        $payload = $this->converter->toPayload($object);
        $this->assertNotNull($payload);
        $this->assertEquals('{"property":"test"}', $payload->getData());
    }

    public function testFromPayload(): void
    {
        $object = new TestClass('test');
        $payload = $this->converter->toPayload($object);
        $result = $this->converter->fromPayload($payload, new Type(TestClass::class));
        $this->assertInstanceOf(TestClass::class, $result);
        $this->assertEquals($object->property, $result->property);
    }
}

final readonly class TestClass
{
    public function __construct(
        public string $property,
    ) {
    }
}

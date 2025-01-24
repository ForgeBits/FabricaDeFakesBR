<?php

namespace ForgeBits\FabricaDeFakes\Tests\Unit\Generators;

use ForgeBits\FabricaDeFakes\Container\DefaultContainer;
use ForgeBits\FabricaDeFakes\Generators\UUID\UUIDGeneratorInterface;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class UuidGeneratorTest extends TestCase
{
    private UUIDGeneratorInterface $generator;
    public function setUp(): void
    {
        $this->generator = DefaultContainer::createContainer()->get('uuidGenerator');
    }

    public function testGenerateUuid()
    {
        $uuid = $this->generator->uuid4();

        $this->assertIsString($uuid);
        $this->assertTrue(Uuid::isValid($uuid));
    }
}
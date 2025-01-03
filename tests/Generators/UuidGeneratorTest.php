<?php

namespace ForgeBits\FabricaDeFakes\Tests\Generators;

use ForgeBits\FabricaDeFakes\Container\DefaultContainer;
use ForgeBits\FabricaDeFakes\Generators\UUID\UUIDGeneratorInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Ramsey\Uuid\Uuid;

class UuidGeneratorTest extends TestCase
{
    /**
     * @throws NotFoundExceptionInterface|ContainerExceptionInterface
     */
    public function testGenerateUuid()
    {
        $c = DefaultContainer::createContainer();

        /** @var UUIDGeneratorInterface $service */
        $service = $c->get('uuidGenerator');
        $uuid = $service->generateUuid4();

        $this->assertIsString($uuid);
        $this->assertTrue(Uuid::isValid($uuid));
    }
}
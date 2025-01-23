<?php

namespace Core;

use ForgeBits\FabricaDeFakes\Container\DefaultContainer;
use ForgeBits\FabricaDeFakes\Generators\Colors\ColorGeneratorInterface;
use ForgeBits\FabricaDeFakes\Generators\Email\EmailGeneratorInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ColorGeneratorTest extends TestCase
{

    /**
     * @throws NotFoundExceptionInterface|ContainerExceptionInterface
     */
    public function __construct(string $name)
    {
        $this->generator = DefaultContainer::createContainer()->get('colorGenerator');

        parent::__construct($name);
    }

    public function testGenerateColor()
    {
        $color = $this->generator->hexadecimalColor();

        $this->assertIsString($color);
        $this->assertMatchesRegularExpression('/^#[0-9A-F]{6}$/', $color);
    }
}
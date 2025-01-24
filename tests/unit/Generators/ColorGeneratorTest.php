<?php

namespace ForgeBits\FabricaDeFakes\Tests\Unit\Generators;

use ForgeBits\FabricaDeFakes\Container\DefaultContainer;
use ForgeBits\FabricaDeFakes\Generators\Colors\ColorGeneratorInterface;
use PHPUnit\Framework\TestCase;

class ColorGeneratorTest extends TestCase
{
    private ColorGeneratorInterface $generator;

    public function setUp(): void
    {
        $this->generator = DefaultContainer::createContainer()->get('colorGenerator');
    }

    public function testGenerateColor()
    {
        $color = $this->generator->hexadecimalColor();

        $this->assertIsString($color);
        $this->assertMatchesRegularExpression('/^#[0-9A-F]{6}$/', $color);
    }
}
<?php

namespace ForgeBits\FabricaDeFakes\Tests\Generators;

use ForgeBits\FabricaDeFakes\Container\DefaultContainer;
use ForgeBits\FabricaDeFakes\Generators\Numbers\RandomNumbers\RandomNumberInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class RandomNumberGeneratorTest extends TestCase
{
    private RandomNumberInterface $generator;

    /**
     * @throws NotFoundExceptionInterface|ContainerExceptionInterface
     */
    public function __construct(string $name)
    {
        $this->generator = DefaultContainer::createContainer()->get('randomNumberGenerator');

        parent::__construct($name);
    }

    /**
     * @throws NotFoundExceptionInterface
     */
    public function testGenerateRandomInteger()
    {
        $randomInteger = $this->generator->randomInteger();

        $this->assertIsInt($randomInteger);
    }

    public function testIfGeneratedRandomIntegerIsBetweenParameters()
    {
        $min = 10;
        $max = 20;

        $randomInteger = $this->generator->randomInteger($min, $max);

        $this->assertGreaterThanOrEqual($min, $randomInteger);
        $this->assertLessThanOrEqual($max, $randomInteger);
    }

    public function testIfGeneratedRandomIntegerHasNotExceptNumbers()
    {
        $except = [1, 2, 3, 4, 5];
        $randomInteger = $this->generator->randomIntegerExcept($except);

        $this->assertNotContains($randomInteger, $except);
    }

    public function testGenerateRandomFloat()
    {
        $randomFloat = $this->generator->randomFloat(1.0, 5.0);

        $this->assertIsFloat($randomFloat);
    }

    public function testIfGeneratedRandomFloatIsBetweenParameters()
    {
        $min = 1.0;
        $max = 10.0;

        $randomFloat = $this->generator->randomFloat($min, $max);

        $this->assertGreaterThanOrEqual($min, $randomFloat);
        $this->assertLessThanOrEqual($max, $randomFloat);
    }

    public function testIfRandomIntegerExceptReturnsExceptionWhenExceptParameterIsEmpty()
    {
        $except = [];

        $this->expectException(\InvalidArgumentException::class);

        $this->generator->randomIntegerExcept($except);
    }

    public function testIfRandomIntegerMinNumberIsGreaterThanMaxNumberAndReturnException()
    {
        $min = 10;
        $max = 5;

        $this->expectException(\InvalidArgumentException::class);

        $this->generator->randomInteger($min, $max);
    }

    public function testIfRandomFloatMinNumberIsGreaterThanMaxNumberAndReturnException()
    {
        $min = 10.0;
        $max = 5.0;

        $this->expectException(\InvalidArgumentException::class);

        $this->generator->randomFloat($min, $max);
    }
}
<?php

namespace ForgeBits\FabricaDeFakes\Tests\Generators;

use ForgeBits\FabricaDeFakes\Container\DefaultContainer;
use ForgeBits\FabricaDeFakes\Generators\Numbers\RandomNumbers\RandomNumberInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\NotFoundExceptionInterface;

class RandomNumberGeneratorTest extends TestCase
{
    private RandomNumberInterface $generator;

    /**
     * @throws NotFoundExceptionInterface
     */
    public function __construct(string $name)
    {
        $this->generator = DefaultContainer::createDefaultContainer()->get('randomNumberGenerator');

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

    public function testIfGeneratedRandomFloatHasNotExceptNumbers()
    {
        $except = [1.0, 2.0, 3.0, 4.0, 5.0];
        $randomFloat = $this->generator->randomFloatExcept($except, 1.0, 10.0);

        $this->assertNotContains($randomFloat, $except);
    }
}
<?php

namespace ForgeBits\FabricaDeFakes\Tests\Generators;

use ForgeBits\FabricaDeFakes\Container\DefaultContainer;
use ForgeBits\FabricaDeFakes\Generators\Names\RandomNameInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class RandomNameGeneratorTest extends TestCase
{
    private RandomNameInterface $generator;

    /**
     * @throws NotFoundExceptionInterface|ContainerExceptionInterface
     */
    public function __construct(string $name)
    {
        $this->generator = DefaultContainer::createContainer()->get('randomNameGenerator');

        parent::__construct($name);
    }

    public function testGenerateRandomName()
    {
        $randomName = $this->generator->randomName();

        $this->assertIsString($randomName);
        $this->assertMatchesRegularExpression('/[a-zA-Z]+/', $randomName);
        $this->assertCount(1, explode(' ', $randomName));
    }

    public function testGenerateRandomNameWithSurnames()
    {
        $randomName = $this->generator->randomName(null, 2);

        $this->assertIsString($randomName);
        $this->assertMatchesRegularExpression('/[a-zA-Z]+/', $randomName);
        $this->assertCount(3, explode(' ', $randomName));
    }

    public function testGenerateRandomNameWithGender()
    {
        $maleName = $this->generator->randomName('male');
        $femaleName = $this->generator->randomName('female');

        $this->assertMatchesRegularExpression('/[a-zA-Z]+/', $maleName);
        $this->assertIsString($maleName);

        $this->assertMatchesRegularExpression('/[a-zA-Z]+/', $femaleName);
        $this->assertIsString($femaleName);
    }

    public function testGenerateRandomNameWithGenderAndSurnames()
    {
        $maleName = $this->generator->randomName('male', 5);
        $femaleName = $this->generator->randomName('female', 5);

        $this->assertMatchesRegularExpression('/[a-zA-Z]+/', $maleName);
        $this->assertIsString($maleName);
        $this->assertCount(6, explode(' ', $maleName));

        $this->assertMatchesRegularExpression('/[a-zA-Z]+/', $femaleName);
        $this->assertIsString($femaleName);
        $this->assertCount(6, explode(' ', $femaleName));
    }

    public function testGenerateRandomNameWithInvalidGender()
    {
        $randomName = $this->generator->randomName('invalid');

        $this->assertMatchesRegularExpression('/[a-zA-Z]+/', $randomName);
        $this->assertIsString($randomName);
    }

    public function testGenerateRandomSurname()
    {
        $randomSurname = $this->generator->randomSurname(5);

        $this->assertMatchesRegularExpression('/[a-zA-Z]+/', $randomSurname);
        $this->assertIsString($randomSurname);
        $this->assertCount(5, explode(' ', $randomSurname));
    }

    public function testGenerateRandomSurnameWithInvalidParameterSurname()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->generator->randomSurname(0);
    }
}
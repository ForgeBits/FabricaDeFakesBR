<?php

namespace ForgeBits\FabricaDeFakes\Tests\Unit\Generators;

use ForgeBits\FabricaDeFakes\Container\DefaultContainer;
use ForgeBits\FabricaDeFakes\Generators\Name\NameGeneratorInterface;
use PHPUnit\Framework\TestCase;

class NameGeneratorTest extends TestCase
{
    private NameGeneratorInterface $generator;

    public function setUp(): void
    {
        $this->generator = DefaultContainer::createContainer()->get('nameGenerator');
    }

    public function testGenerateName()
    {
        $name = $this->generator->name();

        $this->assertIsString($name);
        $this->assertMatchesRegularExpression('/[a-zA-Z]+/', $name);
        $this->assertCount(1, explode(' ', $name));
    }

    public function testGenerateNameWithSurnames()
    {
        $name = $this->generator->name(null, 2);

        $this->assertIsString($name);
        $this->assertMatchesRegularExpression('/[a-zA-Z]+/', $name);
        $this->assertCount(3, explode(' ', $name));
    }

    public function testGenerateNameWithGender()
    {
        $maleName = $this->generator->name('male');
        $femaleName = $this->generator->name('female');

        $this->assertMatchesRegularExpression('/[a-zA-Z]+/', $maleName);
        $this->assertIsString($maleName);

        $this->assertMatchesRegularExpression('/[a-zA-Z]+/', $femaleName);
        $this->assertIsString($femaleName);
    }

    public function testGenerateNameWithGenderAndSurnames()
    {
        $maleName = $this->generator->name('male', 5);
        $femaleName = $this->generator->name('female', 5);

        $this->assertMatchesRegularExpression('/[a-zA-Z]+/', $maleName);
        $this->assertIsString($maleName);
        $this->assertCount(6, explode(' ', $maleName));

        $this->assertMatchesRegularExpression('/[a-zA-Z]+/', $femaleName);
        $this->assertIsString($femaleName);
        $this->assertCount(6, explode(' ', $femaleName));
    }

    public function testGenerateNameWithInvalidGender()
    {
        $name = $this->generator->name('invalid');

        $this->assertMatchesRegularExpression('/[a-zA-Z]+/', $name);
        $this->assertIsString($name);
    }

    public function testGenerateSurname()
    {
        $surname = $this->generator->surname(5);

        $this->assertMatchesRegularExpression('/[a-zA-Z]+/', $surname);
        $this->assertIsString($surname);
        $this->assertCount(5, explode(' ', $surname));
    }

    public function testGenerateSurnameWithInvalidParameterSurname()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->generator->surname(0);
    }
}
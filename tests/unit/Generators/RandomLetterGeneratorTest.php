<?php

namespace ForgeBits\FabricaDeFakes\Tests\Unit\Generators;

use ForgeBits\FabricaDeFakes\Container\DefaultContainer;
use ForgeBits\FabricaDeFakes\Generators\Strings\Letters\Formatters\ArrayFormatter;
use ForgeBits\FabricaDeFakes\Generators\Strings\Letters\Formatters\CommaFormatter;
use ForgeBits\FabricaDeFakes\Generators\Strings\Letters\Formatters\PipeFormatter;
use ForgeBits\FabricaDeFakes\Generators\Strings\Letters\Formatters\SlashFormatter;
use ForgeBits\FabricaDeFakes\Generators\Strings\Letters\RandomLetterInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\NotFoundExceptionInterface;

class RandomLetterGeneratorTest extends TestCase
{
    private RandomLetterInterface $generator;

    public function setUp(): void
    {
        $this->generator = DefaultContainer::createContainer()->get('randomLetterGenerator');
    }

    /**
     * @throws NotFoundExceptionInterface
     */
    public function testGenerateRandomLetter()
    {
        $randomLetter = $this->generator->randomLetter();

        $this->assertIsString($randomLetter);
        $this->assertEquals(1, strlen($randomLetter));
    }

    public function testIfLettersExceptIsNotGenerated()
    {
        $randomLetter = $this->generator->randomLetter(['a', 'b', 'c']);

        $this->assertNotEquals('a', $randomLetter);
        $this->assertNotEquals('b', $randomLetter);
        $this->assertNotEquals('c', $randomLetter);
    }

    public function testIfLetterIsUpperCase()
    {
        $randomLetter = $this->generator->randomLetter(upperCase: true);

        $this->assertMatchesRegularExpression('/[A-Z]/', $randomLetter);
    }

    public function testIfLetterIsLowerCase()
    {
        $randomLetter = $this->generator->randomLetter(upperCase: false);

        $this->assertMatchesRegularExpression('/[a-z]/', $randomLetter);
    }

    public function testGenerateRandomLetters()
    {
        $randomLetters = $this->generator->randomLetters(new ArrayFormatter(), 25);

        $this->assertIsArray($randomLetters);
        $this->assertCount(25, $randomLetters);
    }

    public function testIfLettersExceptIsNotGeneratedInRandomLetters()
    {
        $randomLetters = $this->generator->randomLetters(new ArrayFormatter(), 25, ['a', 'b', 'c']);

        $this->assertNotContains('a', $randomLetters);
        $this->assertNotContains('b', $randomLetters);
        $this->assertNotContains('c', $randomLetters);
    }

    public function testIfLettersAreUpperCaseInRandomLetters()
    {
        $randomLetters = $this->generator->randomLetters(new ArrayFormatter(), 5, upperCase: true);

        foreach ($randomLetters as $randomLetter) {
            $this->assertMatchesRegularExpression('/[A-Z]/', $randomLetter);
        }
    }

    public function testIfLettersAreLowerCaseInRandomLetters()
    {
        $randomLetters = $this->generator->randomLetters(new ArrayFormatter(), 5, upperCase: false);

        foreach ($randomLetters as $randomLetter) {
            $this->assertMatchesRegularExpression('/[a-z]/', $randomLetter);
        }
    }

    public function testIfItemsParameterIsLessThanOne()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->generator->randomLetters(new ArrayFormatter(), 0);
    }

    public function testRandomLettersArrayFormatter()
    {
        $randomLetters = $this->generator->randomLetters(new ArrayFormatter());

        $this->assertIsArray($randomLetters);
    }

    public function testRandomLettersCommaFormatter()
    {
        $randomLetters = $this->generator->randomLetters(new CommaFormatter(), upperCase: false);

        $this->assertIsString($randomLetters);
        $this->assertMatchesRegularExpression('/^[a-z]+(?:,[a-z]+)*$/', $randomLetters);
    }

    public function testRandomLettersPipeFormatter()
    {
        $randomLetters = $this->generator->randomLetters(new PipeFormatter(), upperCase: false);

        $this->assertIsString($randomLetters);
        $this->assertMatchesRegularExpression('/^[a-z]+(?:\|[a-z]+)*$/', $randomLetters);
    }

    public function testRandomLettersSlashFormatter()
    {
        $randomLetters = $this->generator->randomLetters(new SlashFormatter(), upperCase: false);

        $this->assertIsString($randomLetters);
        $this->assertMatchesRegularExpression('/^[a-z]+(?:\/[a-z]+)*$/', $randomLetters);
    }

    public function testIfRandomLettersStartParameterIsGreaterThanEnd()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->generator->randomLettersBetween(new ArrayFormatter(), 'Z', 'A');
    }

    public function testIfItemsParameterIsLessThanOneInRandomLettersBetween()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->generator->randomLettersBetween(new ArrayFormatter(), 'A', 'Z', 0);
    }

    public function testIfRandomLettersIsOnRange()
    {
        $randomLetters = $this->generator->randomLettersBetween(new ArrayFormatter(), 'a', 'g', 25, upperCase: false);

        foreach ($randomLetters as $randomLetter) {
            $this->assertGreaterThanOrEqual('a', $randomLetter);
            $this->assertLessThanOrEqual('g', $randomLetter);
        }
    }
}
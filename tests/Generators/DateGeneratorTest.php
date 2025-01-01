<?php

namespace ForgeBits\FabricaDeFakes\Tests\Generators;

use ForgeBits\FabricaDeFakes\Container\DefaultContainer;
use ForgeBits\FabricaDeFakes\Generators\Date\DateGeneratorInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\NotFoundExceptionInterface;

class DateGeneratorTest extends TestCase
{
    private DateGeneratorInterface $generator;

    /**
     * @throws NotFoundExceptionInterface
     */
    public function __construct(string $name)
    {
        $this->generator = DefaultContainer::createDefaultContainer()->get('dateGenerator');

        parent::__construct($name);
    }

    /**
     * @throws NotFoundExceptionInterface
     */
    public function testGenerateDate()
    {
        $date = $this->generator->generateDate(
            date: '2021-01-01 00:00:04',
        );

        $this->assertIsString($date);
        $this->assertMatchesRegularExpression('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $date);
    }

    public function testIfGeneratedDateWithoutTime()
    {
        $date = $this->generator->generateDate(
            date: '2021-01-01 00:00:04',
            withHours: false,
        );

        $this->assertIsString($date);
        $this->assertMatchesRegularExpression('/^\d{4}-\d{2}-\d{2}$/', $date);
    }

    public function testDateWithTimezone()
    {
        $timezone = 'Pacific/Auckland';

        $dateTimeFaker = $this->generator->generateDate(timezone: $timezone);
        $dateTimeDefault = new \DateTime('now', new \DateTimeZone($timezone));

        $this->assertEquals($dateTimeDefault->format('Y-m-d H:i:s'), $dateTimeFaker);
    }

    public function testAddDays()
    {
        $date = $this->generator->generateDate(
            date: '2021-01-01 00:00:04',
            addDays: 1,
        );

        $this->assertEquals('2021-01-02 00:00:04', $date);
    }

    public function testAddHours()
    {
        $date = $this->generator->generateDate(
            date: '2021-01-01 00:00:04',
            addHours: 1,
        );

        $this->assertEquals('2021-01-01 01:00:04', $date);
    }

    public function testAddMinutes()
    {
        $date = $this->generator->generateDate(
            date: '2021-01-01 00:00:04',
            addMinutes: 1,
        );

        $this->assertEquals('2021-01-01 00:01:04', $date);
    }

    public function testAddSeconds()
    {
        $date = $this->generator->generateDate(
            date: '2021-01-01 00:00:04',
            addSeconds: 1,
        );

        $this->assertEquals('2021-01-01 00:00:05', $date);
    }
}
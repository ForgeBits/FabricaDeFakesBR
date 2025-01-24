<?php

namespace ForgeBits\FabricaDeFakes\Tests\Unit\Generators;

use ForgeBits\FabricaDeFakes\Container\DefaultContainer;
use ForgeBits\FabricaDeFakes\Generators\Email\EmailGeneratorInterface;
use PHPUnit\Framework\TestCase;

class EmailGeneratorTest extends TestCase
{
    private EmailGeneratorInterface $generator;

    public function setUp(): void
    {
        $this->generator = DefaultContainer::createContainer()->get('emailGenerator');
    }

    public function testGenerateEmail()
    {
        $name = $this->generator->email();
        $validate = filter_var($name, FILTER_VALIDATE_EMAIL);

        $this->assertIsString($validate);
    }

    public function testGenerateEmailWithoutDomain()
    {
        $name = $this->generator->emailWithoutDomain();

        $this->assertIsString($name);
    }

    public function testGenerateTld()
    {
        $name = $this->generator->tld();

        $this->assertIsString($name);
    }

    public function testGenerateDomain()
    {
        $name = $this->generator->domain();

        $this->assertIsString($name);
    }
}
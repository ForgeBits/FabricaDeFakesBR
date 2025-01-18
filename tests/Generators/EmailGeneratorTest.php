<?php

namespace ForgeBits\FabricaDeFakes\Tests\Generators;

use ForgeBits\FabricaDeFakes\Container\DefaultContainer;
use ForgeBits\FabricaDeFakes\Generators\Email\EmailGeneratorInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class EmailGeneratorTest extends TestCase
{
    private EmailGeneratorInterface $generator;

    /**
     * @throws NotFoundExceptionInterface|ContainerExceptionInterface
     */
    public function __construct(string $name)
    {
        $this->generator = DefaultContainer::createContainer()->get('emailGenerator');

        parent::__construct($name);
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
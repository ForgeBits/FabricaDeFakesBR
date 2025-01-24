<?php

namespace ForgeBits\FabricaDeFakes\Tests\Unit\Generators;

use ForgeBits\FabricaDeFakes\Container\DefaultContainer;
use ForgeBits\FabricaDeFakes\Generators\Password\PasswordGeneratorInterface;
use PHPUnit\Framework\TestCase;

class PasswordGeneratorTest extends TestCase
{
    private PasswordGeneratorInterface $generator;

    public function setUp(): void
    {
        $this->generator = DefaultContainer::createContainer()->get('passwordGenerator');
    }

    public function testGenerateSimplePassword()
    {
        $password = $this->generator->password(12);

        $this->assertIsString($password);
        $this->assertGreaterThanOrEqual(12, strlen($password));
    }

    public function testGeneratePasswordOnlyWithUpperCase()
    {
        $password = $this->generator->password(12, true, false, false, false);

        $this->assertIsString($password);
        $this->assertGreaterThanOrEqual(12, strlen($password));
        $this->assertMatchesRegularExpression('/^[A-Z]+$/', $password);
    }

    public function testGeneratePasswordOnlyWithLowerCase()
    {
        $password = $this->generator->password(12, false, true, false, false);

        $this->assertIsString($password);
        $this->assertGreaterThanOrEqual(12, strlen($password));
        $this->assertMatchesRegularExpression('/^[a-z]+$/', $password);
    }

    public function testGeneratePasswordOnlyWithNumbers()
    {
        $password = $this->generator->password(12, false, false, true, false);

        $this->assertIsString($password);
        $this->assertGreaterThanOrEqual(12, strlen($password));
        $this->assertMatchesRegularExpression('/^[0-9]+$/', $password);
    }

    public function testGeneratePasswordOnlyWithSpecialCaracters()
    {
        $password = $this->generator->password(12, false, false, false, true);

        $this->assertIsString($password);
        $this->assertGreaterThanOrEqual(12, strlen($password));
        $this->assertMatchesRegularExpression('/^[!@#$%&*()_+^]+$/', $password);
    }

    public function testGeneratePasswordWithAllCaracters()
    {
        $password = $this->generator->password(12, true, true, true, true);

        $this->assertIsString($password);
        $this->assertGreaterThanOrEqual(12, strlen($password));
        $this->assertMatchesRegularExpression('/^[A-Za-z0-9!@#$%&*()_+^]+$/', $password);
    }

    public function testGeneratePasswordWithUpperCaseAndLowerCase()
    {
        $password = $this->generator->password(12, true, true, false, false);

        $this->assertIsString($password);
        $this->assertGreaterThanOrEqual(12, strlen($password));
        $this->assertMatchesRegularExpression('/^[A-Za-z]+$/', $password);
    }

    public function testGeneratePasswordWithUpperCaseAndNumbers()
    {
        $password = $this->generator->password(12, true, false, true, false);

        $this->assertIsString($password);
        $this->assertGreaterThanOrEqual(12, strlen($password));
        $this->assertMatchesRegularExpression('/^[A-Z0-9]+$/', $password);
    }

    public function testGeneratePasswordWithUpperCaseAndSpecialCaracters()
    {
        $password = $this->generator->password(12, true, false, false, true);

        $this->assertIsString($password);
        $this->assertGreaterThanOrEqual(12, strlen($password));
        $this->assertMatchesRegularExpression('/^[A-Z!@#$%&*()_+^]+$/', $password);
    }

    public function testGeneratePasswordWithLowerCaseAndNumbers()
    {
        $password = $this->generator->password(12, false, true, true, false);

        $this->assertIsString($password);
        $this->assertGreaterThanOrEqual(12, strlen($password));
        $this->assertMatchesRegularExpression('/^[a-z0-9]+$/', $password);
    }

    public function testGenerateEncryptPassword()
    {
        $bcrypt = $this->generator->password(12, true, true, true, true, PASSWORD_BCRYPT);
        $argon2i = $this->generator->password(12, true, true, true, true, PASSWORD_ARGON2I);
        $argon2id = $this->generator->password(12, true, true, true, true, PASSWORD_ARGON2ID);

        $this->assertIsString($bcrypt);
        $this->assertIsString($argon2i);
        $this->assertIsString($argon2id);
    }
}
<?php

namespace ForgeBits\FabricaDeFakes\Tests\Unit\Core;

use ForgeBits\FabricaDeFakes\Core\Email;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

class EmailCoreTest extends TestCase
{
    public static function emailProvider(): array
    {
        return [
            [new Email()],
            [new Email('fulano')],
        ];
    }

    #[DataProvider('emailProvider')]
    #[TestDox('Teste de instanciação inicial do core de email')]
    public function testInitialInstanceEmailCore(Email $email)
    {
        $this->assertIsString($email->getUsername());
        $this->assertIsString($email->getDomain());
        $this->assertIsString($email->getTld());
        $this->assertIsString((string)$email);
    }

    #[DataProvider('emailProvider')]
    #[TestDox('Teste para inserir um dominio manualmente')]
    public function testSetDomain(Email $email)
    {
        $emailReturn = $email->setDomain('forgebits');

        $this->assertMatchesRegularExpression('/^[a-zA-Z]+$/', $email->getDomain());
        $this->assertEquals('forgebits', $email->getDomain());
        $this->assertIsString($email->getDomain());
        $this->assertInstanceOf(Email::class, $emailReturn);
    }

    #[DataProvider('emailProvider')]
    #[TestDox('Teste para verificar se, quando o formato for incorreto, deve lançar uma exceção do tipo InvalidArgumentException')]
    public function testIfWhenIncorrectDomainFormatItThrowsInvalidArgumentException(Email $email)
    {
        $this->expectException(\InvalidArgumentException::class);
        $email->setDomain('forgebits.com');
    }

    #[DataProvider('emailProvider')]
    #[TestDox('Teste para inserir um TLD manualmente')]
    public function testSetTld(Email $email)
    {
        $emailReturn = $email->setTld('com');

        $this->assertMatchesRegularExpression('/^[a-zA-Z]{2,4}$/', $email->getTld());
        $this->assertEquals('com', $email->getTld());
        $this->assertIsString($email->getTld());
        $this->assertInstanceOf(Email::class, $emailReturn);
    }

    #[DataProvider('emailProvider')]
    #[TestDox('Teste para verificar se, quando o formato for incorreto, deve lançar uma exceção do tipo InvalidArgumentException')]
    public function testIfWhenIncorrectTldFormatItThrowsInvalidArgumentException(Email $email)
    {
        $this->expectException(\InvalidArgumentException::class);
        $email->setTld('com.br');
    }
}
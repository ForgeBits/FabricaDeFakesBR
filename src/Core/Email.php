<?php

namespace ForgeBits\FabricaDeFakes\Core;

use ForgeBits\FabricaDeFakes\Resources\Name;
use ForgeBits\FabricaDeFakes\Resources\Email as EmailResource;

class Email
{
    private string $username;
    private string $domain;
    private string $tld;

    public function __construct(?string $username = null)
    {
        $this->username = $username ?? EmailResource::username()[array_rand(Name::getSurnames())];
        $this->domain = EmailResource::getDomain()[array_rand(EmailResource::getDomain())];
        $this->tld = EmailResource::getTld()[array_rand(EmailResource::getTld())];
    }

    public function setDomain(string $domain): self
    {
        if (!preg_match('/^[a-zA-Z]+$/', $domain)) {
            throw new \InvalidArgumentException('Domain must contain only letters');
        }

        $this->domain = $domain;
        return $this;
    }

    public function setTld(string $tld): self
    {
        if (!preg_match('/^[a-zA-Z]{2,4}$/', $tld)) {
            throw new \InvalidArgumentException('O TLD deve conter entre 2 a 4 letras, sem caracteres especiais.');
        }

        $this->tld = $tld;
        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getTld(): string
    {
        return $this->tld;
    }

    public function __toString(): string
    {
        return $this->username . rand(10, 99) . '@' . $this->domain . '.' . $this->tld;
    }
}
<?php

namespace ForgeBits\FabricaDeFakes\Core;

use DomainException;

class Password
{
    private ?string $caracters = null;
    private ?string $password = '';

    public function password(?string $passwordHash = null, ?array $options = []): string
    {
        if (is_null($this->password)) {
            throw new DomainException('Password not generated');
        }

        if ($passwordHash) {
            return password_hash($this->password, $passwordHash, $options);
        }

        return $this->password;
    }

    public function generate(int $length = 8): void
    {
        if (is_null($this->caracters)) {
            throw new DomainException('You must enable at least one type of character');
        }

        $password = '';
        $charactersLength = strlen($this->caracters);

        for ($i = 0; $i < $length; $i++) {
            $password .= $this->caracters[rand(0, $charactersLength - 1)];
        }

        $this->password = $password;
    }

    public function enableUpperCaseCaracters(): self
    {
        $this->caracters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return $this;
    }

    public function enableLowerCaseCaracters(): self
    {
        $this->caracters .= 'abcdefghijklmnopqrstuvwxyz';
        return $this;
    }

    public function enableNumbers(): self
    {
        $this->caracters .= '0123456789';
        return $this;
    }

    public function enableSpecialCaracters(): self
    {
        $this->caracters .= '!@#$%&*()_+^';
        return $this;
    }
}
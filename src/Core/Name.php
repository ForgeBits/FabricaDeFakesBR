<?php

namespace ForgeBits\FabricaDeFakes\Core;

class Name
{
    private string $name;
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setSurname(array|string $surname): self
    {
        if (empty($this->name)) {
            throw new \DomainException('Name is required to set surname');
        }

        if (empty($surname)) {
            throw new \InvalidArgumentException('Surname is required');
        }

        if (is_array($surname)) {
            foreach ($surname as $s) {
                if (!is_string($s)) {
                    throw new \InvalidArgumentException('Surname must be an array of strings');
                }
            }
        }

        if (is_array($surname)) {
            $this->name = $this->name . ' '. implode(' ', $surname);
            return $this;
        }

        $this->name = $this->name .= ' ' . $surname;

        return $this;
    }
}
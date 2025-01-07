<?php

namespace ForgeBits\FabricaDeFakes\Generators\Name;

use ForgeBits\FabricaDeFakes\Resources\Name;

class HandleName
{
    public function getName(?string $gender = null): string
    {
        return match ($gender) {
            'female' => Name::getFemaleNames()[array_rand(Name::getFemaleNames())],
            'male' => Name::getMaleNames()[array_rand(Name::getMaleNames())],
            default => Name::mergeMalesAndFemalesNames()[array_rand(Name::mergeMalesAndFemalesNames())],
        };
    }

    public function getSurname(?int $surnames = 0): string
    {
        $surname = [];

        for ($i = 0; $i < $surnames; $i++) {
            $surname[] = Name::getSurnames()[array_rand(Name::getSurnames())];
        }

        return implode(' ', $surname);
    }
}
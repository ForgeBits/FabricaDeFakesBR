<?php

namespace ForgeBits\FabricaDeFakes\Generators\Numbers\RandomDigit;

class RandomDigit implements RandomDigitInterface
{
    public function randomDigit(?int $min = 0, ?int $max = PHP_INT_MAX): int
    {
        return random_int($min, $max);
    }
}
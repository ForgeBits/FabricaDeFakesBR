<?php

namespace ForgeBits\FabricaDeFakes\Generators\Numbers\RandomDigit;

interface RandomDigitInterface
{
    public function randomDigit(?int $min = 0, ?int $max = PHP_INT_MAX): int;
}
<?php

namespace ForgeBits\FabricaDeFakes\Generators\Numbers\RandomNumbers;

interface RandomNumberInterface
{
    public function randomInteger(?int $min = 0, ?int $max = PHP_INT_MAX): int;

    public function randomIntegerExcept(array $except, ?int $min = 0, ?int $max = PHP_INT_MAX): int;

    public function randomFloat(?float $min = 0.0, ?float $max = PHP_FLOAT_MAX): float;
}
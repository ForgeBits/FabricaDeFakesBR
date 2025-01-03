<?php

namespace ForgeBits\FabricaDeFakes\Generators\Numbers\RandomManyNumbers;

interface RandomManyNumbersInterface
{
    public function randomManyIntegerNumbers(int $items, ?int $min = 0, ?int $max = PHP_INT_MAX): array;
    public function randomManyIntegerNumbersExcept(array $except, int $items, ?int $min = 0, ?int $max = PHP_INT_MAX): array;
    public function randomManyFloatNumbers(int $items, ?float $min = 0.0, ?float $max = PHP_FLOAT_MAX): array;
}
<?php

namespace ForgeBits\FabricaDeFakes\Generators\Numbers\RandomManyNumbers;

use ForgeBits\FabricaDeFakes\Generators\Numbers\GenerateFloatNumber;
use ForgeBits\FabricaDeFakes\Generators\Numbers\RandomManyNumbers\RandomManyNumbersInterface;

class RandomManyNumbers implements RandomManyNumbersInterface
{
    /**
     * Gera um array com números inteiros aleatórios entre os valores informados.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomInteger = $faker->randomManyIntegerNumbers(10, 1, 10);
     * </code>
     *
     * @param int $items Quantidade de números a serem gerados.
     * @param int|null $min Valor mínimo do número gerado.
     * @param int|null $max Valor máximo do número gerado.
     *
     * @return array Um array com os números gerados.
     */
    public function randomManyIntegerNumbers(int $items = 10, ?int $min = 0, ?int $max = PHP_INT_MAX): array
    {
        $randomInteger = [];

        if ($min > $max) {
            throw new \InvalidArgumentException('The minimum value cannot be greater than the maximum value.');
        }

        if ($items < 1) {
            throw new \InvalidArgumentException('The number of items must be greater than 0.');
        }

        for ($i = 0; $i < $items; $i++) {
            $randomInteger[] = random_int($min, $max);
        }

        return $randomInteger;
    }

    /**
     * Gera um array com números inteiros aleatórios entre os valores informados, exceto os valores informados no array $except.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomInteger = $faker->randomManyIntegerNumbersExcept([1,2,3,4,5], 10, 1, 10);
     * </code>
     *
     * @param array $except Valores que não podem ser gerados.
     * @param int $items Quantidade de números a serem gerados.
     * @param int|null $min Valor mínimo do número gerado.
     * @param int|null $max Valor máximo do número gerado.
     *
     * @return array Um array com os números gerados.
     */
    public function randomManyIntegerNumbersExcept(array $except, int $items = 10, ?int $min = 0, ?int $max = PHP_INT_MAX): array
    {
        $randomInteger = [];

        if ($min > $max) {
            throw new \InvalidArgumentException('The minimum value cannot be greater than the maximum value.');
        }

        if ($items < 1) {
            throw new \InvalidArgumentException('The number of items must be greater than 0.');
        }

        for ($i = 0; $i < $items; $i++) {
            $number = random_int($min, $max);

            if (in_array($number, $except)) {
                $i--;
                continue;
            }

            $randomInteger[] = $number;
        }

        return $randomInteger;
    }

    /**
     * Gera um array com números do tipo float aleatórios entre os valores informados.
     *
     * <code>
     *     $faker = new FakerBase();
     *    $randomFloat = $faker->randomManyFloatNumbers(10, 1.0, 10.0);
     * </code>
     *
     * @param int $items Quantidade de números a serem gerados.
     * @param float|null $min Valor mínimo do número gerado.
     * @param float|null $max Valor máximo do número gerado.
     *
     * @return array Um array com os números gerados.
     */
    public function randomManyFloatNumbers(int $items = 10, ?float $min = 0.0, ?float $max = PHP_FLOAT_MAX): array
    {
        $randomFloatNumbers = [];

        if ($min > $max) {
            throw new \InvalidArgumentException('The minimum value cannot be greater than the maximum value.');
        }

        if ($items < 1) {
            throw new \InvalidArgumentException('The number of items must be greater than 0.');
        }

        for ($i = 0; $i < $items; $i++) {
            $randomFloatNumbers[] = GenerateFloatNumber::generateFloatNumber($min, $max);
        }

        return $randomFloatNumbers;
    }
}
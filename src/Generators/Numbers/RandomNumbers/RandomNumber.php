<?php

namespace ForgeBits\FabricaDeFakes\Generators\Numbers\RandomNumbers;

class RandomNumber implements RandomNumberInterface
{
    /**
     * Gera um número aleatório entre os valores informados.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomDigit = $faker->randomDigit(0, 100);
     * </code>
     *
     * @param int|null $min Valor mínimo do número gerado.
     * @param int|null $max Valor máximo do número gerado.
     *
     * @return int O número gerado ou previamente armazenado.
     */

    public function randomInteger(?int $min = 0, ?int $max = PHP_INT_MAX): int
    {
        if ($min > $max) {
            throw new \InvalidArgumentException('The minimum value cannot be greater than the maximum value.');
        }

        return random_int($min, $max);
    }

    /**
     * Gera um número aleatório entre os valores informados, exceto os valores informados no array $except.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomDigit = $faker->randomDigitExcept([1,2,3,4,5], 1, 10);
     * </code>
     *
     * @param array $except Valores que não podem ser gerados.
     * @param int|null $min Valor mínimo do número gerado.
     * @param int|null $max Valor máximo do número gerado.
     *
     * @return int O número gerado ou previamente armazenado.
     */

    public function randomIntegerExcept(array $except, ?int $min = 0, ?int $max = PHP_INT_MAX): int
    {
        if (empty($except)) {
            throw new \InvalidArgumentException('The array $except cannot be empty.');
        }

        if ($min > $max) {
            throw new \InvalidArgumentException('The minimum value cannot be greater than the maximum value.');
        }

        $randomInteger = random_int($min, $max);

        while (in_array($randomInteger, $except)) {
            $randomInteger = random_int($min, $max);
        }

        return $randomInteger;
    }

    /**
     * Gera um número do tipo float aleatório entre os valores informados.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomFloat = $faker->randomFloat(1.0, 10.0);
     * </code>
     *
     * @param float|null $min
     * @param float|null $max
     * @return float
     *
     */
    public function randomFloat(?float $min = 0.0, ?float $max = PHP_FLOAT_MAX): float
    {
        return $this->generateFloatNumber($min, $max);
    }

    /**
     * Gera um número do tipo float aleatório entre os valores informados, exceto os valores informados no array $except.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomFloat = $faker->randomFloatExcept([1.0, 2.0, 3.0, 4.0, 5.0], 1.0, 10.0);
     * </code>
     *
     * @param array $except Valores que não podem ser gerados.
     * @param float|null $min Valor mínimo do número gerado.
     * @param float|null $max Valor máximo do número gerado.
     *
     * @return float O número gerado ou previamente armazenado.
     */
    public function randomFloatExcept(array $except, ?float $min = 0.0, ?float $max = PHP_FLOAT_MAX): float
    {
        if (empty($except)) {
            throw new \InvalidArgumentException('The array $except cannot be empty.');
        }

        $randomFloat = $this->generateFloatNumber($min, $max);

        while (in_array($randomFloat, $except)) {
            $randomFloat = $this->generateFloatNumber($min, $max);
        }

        return $randomFloat;
    }

    /**
     * @param float|null $min
     * @param float|null $max
     * @return float
     */
    private function generateFloatNumber(?float $min, ?float $max): float
    {
        $number = $min + mt_rand() / mt_getrandmax() * ($max - $min);

        return (float) number_format($number, 2, '.', '');
    }
}
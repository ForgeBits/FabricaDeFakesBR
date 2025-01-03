<?php

namespace ForgeBits\FabricaDeFakes\Generators\Numbers;

class GenerateFloatNumber
{
    /**
     * Gera um número float aleatório entre os valores informados.
     *
     * @param float $min Valor mínimo do número gerado.
     * @param float $max Valor máximo do número gerado.
     *
     * @return float O número gerado.
     */
    public static function generateFloatNumber(?float $min, ?float $max): float
    {
        $number = $min + mt_rand() / mt_getrandmax() * ($max - $min);

        return (float)number_format($number, 2, '.', '');
    }
}
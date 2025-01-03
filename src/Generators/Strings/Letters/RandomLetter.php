<?php

namespace ForgeBits\FabricaDeFakes\Generators\Strings\Letters;

use ForgeBits\FabricaDeFakes\Generators\Strings\Letters\Formatters\FormatterLetterInterface;
use InvalidArgumentException;

class RandomLetter implements RandomLetterInterface
{
    /**
     * Gera uma letra aleatória.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomLetter = $faker->randomLetter();
     * </code>
     *
     * @param array|null $except Letras que não podem ser geradas.
     * @param bool|null $upperCase Se a letra gerada deve ser maiúscula.
     *
     * @return string A letra gerada.
     */
    public function randomLetter(?array $except = [], ?bool $upperCase = false): string
    {
        if ($upperCase) {
            $alphabet = range('A', 'Z');
        } else {
            $alphabet = range('a', 'z');
        }

        $letter = $alphabet[array_rand($alphabet)];

        while (in_array($letter, $except)) {
            $letter = $alphabet[array_rand($alphabet)];
        }

        return $letter;
    }

    /**
     * Gera um array com letras aleatórias.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomLetters = $faker->randomLetters(formatterLetters: new ArrayFormatter(), items: 25, except: ['C'], upperCase: true);
     * </code>
     *
     * @param FormatterLetterInterface $formatterLetters
     * @param int $items Quantidade de letras a serem geradas.
     * @param array|null $except Letras que não podem ser geradas.
     * @param bool|null $upperCase Se as letras geradas devem ser maiúsculas.
     *
     * @return array|string Um array ou string com as letras geradas no formato informado.
     */
    public function randomLetters(FormatterLetterInterface $formatterLetters, int $items = 10, ?array $except = [], ?bool $upperCase = false): array|string
    {
        if ($items < 1) {
            throw new InvalidArgumentException('The number of items must be greater than 0.');
        }

        $letters = [];

        for ($i = 0; $i < $items; $i++) {
            $letters[] = $this->randomLetter($except, $upperCase);
        }

        return $formatterLetters->handle($letters);
    }

    /**
     * Gera um array com letras aleatórias entre os valores informados.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomLetters = $faker->randomLettersBetween(formatterLetters: new ArrayFormatter(), start: 'A', end: 'Z', items: 25, except: ['C'], upperCase: true);
     * </code>
     *
     * @param FormatterLetterInterface $formatterLetters
     * @param string $start Letra inicial.
     * @param string $end Letra final.
     * @param int $items Quantidade de letras a serem geradas.
     * @param array|null $except Letras que não podem ser geradas.
     * @param bool|null $upperCase Se as letras geradas devem ser maiúsculas.
     *
     * @return array|string Um array ou string com as letras geradas no formato informado.
     *
     * @throws InvalidArgumentException
     */
    public function randomLettersBetween(FormatterLetterInterface $formatterLetters, string $start, string $end, int $items = 10, ?array $except = [], ?bool $upperCase = false): array|string
    {
        if (ord($start) > ord($end)) {
            throw new InvalidArgumentException('The start value cannot be greater than the end value.');
        }

        if ($items < 1) {
            throw new InvalidArgumentException('The number of items must be greater than 0.');
        }

        $letters = [];

        if ($upperCase) {
            $alphabet = range($start, $end);
        } else {
            $alphabet = range(strtolower($start), strtolower($end));
        }

        for ($i = 0; $i < $items; $i++) {
            $letter = $alphabet[array_rand($alphabet)];

            while (in_array($letter, $except)) {
                $letter = $alphabet[array_rand($alphabet)];
            }

            $letters[] = $letter;
        }

        return $formatterLetters->handle($letters);
    }
}
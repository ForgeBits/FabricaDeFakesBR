<?php

namespace ForgeBits\FabricaDeFakes\Generators\Strings\Letters;

use ForgeBits\FabricaDeFakes\Generators\Strings\Letters\Formatters\FormatterLetterInterface;

interface RandomLetterInterface
{
    public function randomLetter(?array $except = [], ?bool $upperCase = false): string;
    public function randomLetters(FormatterLetterInterface $formatterLetters, int $items = 10, ?array $except = [], ?bool $upperCase = false): array|string;
    public function randomLettersBetween(FormatterLetterInterface $formatterLetters, string $start, string $end, int $items = 10, ?array $except = [], ?bool $upperCase = false): array|string;
}
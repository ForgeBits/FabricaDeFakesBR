<?php

namespace ForgeBits\FabricaDeFakes\Generators\Strings\Letters\Formatters;

class ArrayFormatter implements FormatterLetterInterface
{
    public function handle(array $letters): string|array
    {
        return $letters;
    }
}
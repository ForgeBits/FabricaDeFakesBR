<?php

namespace ForgeBits\FabricaDeFakes\Generators\Strings\Letters\Formatters;

use ForgeBits\FabricaDeFakes\Generators\Strings\Letters\Formatters\FormatterLetterInterface;

class CommaFormatter implements FormatterLetterInterface
{
    public function handle(array $letters): string|array
    {
        return implode(',', $letters);
    }
}
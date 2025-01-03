<?php

namespace ForgeBits\FabricaDeFakes\Generators\Strings\Letters\Formatters;

class SlashFormatter implements FormatterLetterInterface
{
    public function handle(array $letters): string|array
    {
        return implode('/', $letters);
    }
}
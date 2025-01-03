<?php

namespace ForgeBits\FabricaDeFakes\Generators\Strings\Letters\Formatters;

class PipeFormatter implements FormatterLetterInterface
{
    public function handle(array $letters): string|array
    {
        return implode('|', $letters);
    }
}
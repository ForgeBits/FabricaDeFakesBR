<?php

namespace ForgeBits\FabricaDeFakes\Generators\Strings\Letters\Formatters;

interface FormatterLetterInterface
{
    public function handle(array $letters): string|array;
}
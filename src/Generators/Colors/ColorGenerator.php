<?php

namespace ForgeBits\FabricaDeFakes\Generators\Colors;

class ColorGenerator implements ColorGeneratorInterface
{
    public function hexadecimalColor(): string
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}
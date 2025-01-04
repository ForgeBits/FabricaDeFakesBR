<?php

namespace ForgeBits\FabricaDeFakes\Generators\Names;

interface RandomNameInterface
{
    public function randomName(?string $gender = null, ?int $surnames = 2): string;
    public function randomMaleName(?int $surnames = 0): string;
    public function randomFemaleName(?int $surnames = 0): string;
    public function randomSurname(?int $surnames = 1): string;
}
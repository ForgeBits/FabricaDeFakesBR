<?php

namespace ForgeBits\FabricaDeFakes\Generators\Name;

interface NameInterface
{
    public function name(?string $gender = null, ?int $surnames = 2): string;
    public function maleName(?int $surnames = 0): string;
    public function femaleName(?int $surnames = 0): string;
    public function surname(?int $surnames = 1): string;
}
<?php

namespace ForgeBits\FabricaDeFakes\Generators\Password;

interface PasswordGeneratorInterface
{
    public function password(
        int $length = 8,
        ?bool $upperCase = false,
        ?bool $lowerCase = true,
        ?bool $numbers = false,
        ?bool $specialCaracteres = false,
        ?string $passwordHash = null,
        ?array $options = []
    ): string;
}
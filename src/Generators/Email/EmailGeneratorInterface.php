<?php

namespace ForgeBits\FabricaDeFakes\Generators\Email;

interface EmailGeneratorInterface
{
    public function email(?string $username = null, ?string $domain = null, ?string $tld = null): string;
    public function emailWithoutDomain(?string $username = null): string;

    public function tld(): string;
    public function domain(): string;
}
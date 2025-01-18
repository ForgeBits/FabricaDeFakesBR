<?php

namespace ForgeBits\FabricaDeFakes\Generators\Email;

use ForgeBits\FabricaDeFakes\Core\Email as EmailCore;
use ForgeBits\FabricaDeFakes\Resources\Email as EmailResources;

class EmailGenerator implements EmailGeneratorInterface
{
    public function email(?string $username = null, ?string $domain = null, ?string $tld = null): string
    {
        $email = new EmailCore($username);

        if ($domain) {
            $email->setDomain($domain);
        }

        if ($tld) {
            $email->setTld($tld);
        }

        return $email;
    }

    public function emailWithoutDomain(?string $username = null): string
    {
        $email = new EmailCore($username);
        $emailExploded = explode('@', $email);

        return $emailExploded[0];
    }

    public function tld(): string
    {
        return '.'.EmailResources::getTld()[array_rand(EmailResources::getTld())];
    }

    public function domain(): string
    {
        return EmailResources::getDomain()[array_rand(EmailResources::getDomain())];
    }
}
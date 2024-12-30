<?php

namespace ForgeBits\FabricaDeFakes\Generators\UUID;

use Ramsey\Uuid\Uuid;

class RamseyUUIDGenerator implements UUIDGeneratorInterface
{
    public function generateUuid4(): string
    {
        return Uuid::uuid4()->toString();
    }
}
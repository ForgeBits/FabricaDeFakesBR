<?php

namespace ForgeBits\FabricaDeFakes\Generators\UUID;

use Ramsey\Uuid\Uuid;

class RamseyUUIDGenerator implements UUIDGeneratorInterface
{
    /**
     * Obtém ou gera um UUID na versão 4.
     *
     * Este metodo verifica se o UUID já foi gerado anteriormente. Caso contrário,
     * utiliza o gerador de UUID registrado no container para criar um novo UUID.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $uuid = $faker->uuid();
     * </code>
     *
     * @return string O UUID gerado ou previamente armazenado.
     */
    public function uuid4(): string
    {
        return Uuid::uuid4()->toString();
    }
}
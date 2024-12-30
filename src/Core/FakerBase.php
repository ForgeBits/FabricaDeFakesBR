<?php

namespace ForgeBits\FabricaDeFakes\Core;

use ForgeBits\FabricaDeFakes\Container\DefaultContainer;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class FakerBase
{
    protected string $uuid;
    protected $date;
    protected ?ContainerInterface $c;

    public function __construct()
    {
        $this->c = DefaultContainer::createDefaultContainer();
    }

    /**
     * Obtém ou gera um UUID na versão 4.
     *
     * Este metodo verifica se o UUID já foi gerado anteriormente. Caso contrário,
     * utiliza o gerador de UUID registrado no container para criar um novo UUID.
     *
     * @return string O UUID gerado ou previamente armazenado.
     */
    public function uuid(): string
    {
        if (empty($this->uuid)) {
            $this->uuid = $this->c->get('uuidGenerator')->generateUuid4();
        }

        return $this->uuid;
    }

    /**
     * Gera uma data com base nos parâmetros informados.
     *
     * Este metodo verifica se a data já foi gerada anteriormente. Caso contrário, uma nova data é gerada.
     *
     * @param string|null $date Data base para a geração da nova data.
     * @param string|null $timezone Fuso horário da data gerada.
     * @param int|null $addDays Quantidade de dias a serem adicionados à data.
     * @param int|null $addHours Quantidade de horas a serem adicionadas à data.
     * @param int|null $addMinutes Quantidade de minutos a serem adicionados à data.
     * @param int|null $addSeconds Quantidade de segundos a serem adicionados à data.
     * @param bool|null $withHours Indica se a data gerada deve conter as horas.
     *
     * @return string A data gerada ou previamente armazenada.
     *
     */
    public function date(
        ?string $date = null,
        ?string $timezone = 'GMT-3',
        ?int $addDays = 0,
        ?int $addHours = 0,
        ?int $addMinutes = 0,
        ?int $addSeconds = 0,
        ?bool $withHours = true
    ): string
    {
        if (empty($this->date)) {
            $this->date = $this->c->get('dateGenerator')->generateDate(
                $date,
                $timezone,
                $addDays,
                $addHours,
                $addMinutes,
                $addSeconds,
                $withHours
            );
        }

        return $this->date;
    }
}
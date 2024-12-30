<?php

namespace ForgeBits\FabricaDeFakes\Core;

use ForgeBits\FabricaDeFakes\Container\DefaultContainer;
use Psr\Container\ContainerInterface;

/**
 * @property string uuid
 * @property string date
 * @property int randomDigit
 */
class FakerBase
{
    protected ?ContainerInterface $c;
    protected array $data = [];

    public function __construct()
    {
        $this->c = DefaultContainer::createDefaultContainer();
    }

    public function __call(string $name, array $arguments)
    {
        if (method_exists($this, $name)) {
            return $this->$name(...$arguments);
        }

        throw new \BadMethodCallException("Método {$name} não existe.");
    }

    public function __get(string $name)
    {
        if (method_exists($this, $name)) {
            return $this->$name();
        }

        throw new \BadMethodCallException("Método {$name} não existe.");
    }

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
    public function uuid(): string
    {
        if (empty($this->data['uuid'])) {
            $this->data['uuid'] = $this->c->get('uuidGenerator')->generateUuid4();
        }

        return $this->data['uuid'];
    }

    /**
     * Gera uma data com base nos parâmetros informados.
     *
     * Este metodo verifica se a data já foi gerada anteriormente. Caso contrário, uma nova data é gerada.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $date = $faker->date(
     *       date: '2021-01-01 00:00:04',
     *       addDays: 1,
     *       addHours: 2,
     *       addMinutes: 3,
     *       addSeconds: 4,
     *    );
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
        if (empty($this->data['date'])) {
            $this->data['date'] = $this->c->get('dateGenerator')->generateDate(
                $date,
                $timezone,
                $addDays,
                $addHours,
                $addMinutes,
                $addSeconds,
                $withHours
            );
        }
        return $this->data['date'];
    }

    /**
     * Gera um número aleatório entre os valores informados.
     *
     * Este metodo verifica se o número já foi gerado anteriormente. Caso contrário, um novo número é gerado.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomDigit = $faker->randomDigit(0, 100);
     * </code>
     *
     * @param int|null $min Valor mínimo do número gerado.
     * @param int|null $max Valor máximo do número gerado.
     *
     * @return int O número gerado ou previamente armazenado.
     */
    public function randomDigit(?int $min = 0, ?int $max = PHP_INT_MAX): int
    {
        if (empty($this->data['randomDigit'])) {
            $this->data['randomDigit'] = $this->c->get('randomDigitGenerator')->randomDigit($min, $max);
        }

        return $this->data['randomDigit'];
    }
}
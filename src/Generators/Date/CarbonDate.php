<?php

namespace ForgeBits\FabricaDeFakes\Generators\Date;

use Carbon\Carbon;

class CarbonDate implements DateGeneratorInterface
{
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
    public function generateDate(
        ?string $date = null,
        ?string $timezone = 'GMT-3',
        ?int $addDays = 0,
        ?int $addHours = 0,
        ?int $addMinutes = 0,
        ?int $addSeconds = 0,
        ?bool $withHours = true
    ): string
    {
        if ($date) {
            $newDate = Carbon::parse($date, $timezone);
        } else {
            $newDate = Carbon::now($timezone);
        }

        if ($addDays) {
            $newDate->addDays($addDays);
        }

        if ($addHours) {
            $newDate->addHours($addHours);
        }

        if ($addMinutes) {
            $newDate->addMinutes($addMinutes);
        }

        if ($addSeconds) {
            $newDate->addSeconds($addSeconds);
        }

        if ($withHours) {
            return $newDate->format('Y-m-d H:i:s');
        }

        return $newDate->format('Y-m-d');
    }
}
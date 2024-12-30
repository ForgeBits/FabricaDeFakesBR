<?php

namespace ForgeBits\FabricaDeFakes\Generators\Date;

interface DateGeneratorInterface
{
    public function generateDate(
        ?string $date = null,
        ?string $timezone = 'GMT-3',
        ?int $addDays = 0,
        ?int $addHours = 0,
        ?int $addMinutes = 0,
        ?int $addSeconds = 0,
        ?bool $withHours = true
    ): string;
}
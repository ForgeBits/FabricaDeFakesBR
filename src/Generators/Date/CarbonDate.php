<?php

namespace ForgeBits\FabricaDeFakes\Generators\Date;

use Carbon\Carbon;

class CarbonDate implements DateGeneratorInterface
{
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
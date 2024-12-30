<?php

require_once __DIR__ . '/vendor/autoload.php';

use ForgeBits\FabricaDeFakes\Core\FakerBase;

//$fakerPack = \Faker\Factory::create('pt_BR');
//dd($fakerPack);

$faker = new FakerBase();
$faker->uuid();
$faker->date(
    date: '2021-01-01 00:00:04',
    addDays: 1,
    addHours: 2,
    addMinutes: 3,
    addSeconds: 4,
);

dump($faker);
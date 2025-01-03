<?php

require_once __DIR__ . '/vendor/autoload.php';

use ForgeBits\FabricaDeFakes\Core\FakerBase;

/*$fakerPack = \Faker\Factory::create('pt_BR');
$fakerPack->uuid();
dd($fakerPack);*/

$faker = new FakerBase();
$faker->uuid();
$faker->date();

$faker->randomInteger(1, 10);
$faker->randomIntegerExcept([1,2,3,4,5], 1, 10);
$faker->randomFloat(1.0, 10.0);

$faker->randomManyIntegerNumbers(20, 1, 10);
$faker->randomManyIntegerNumbersExcept([1,2,3,4,5], 20, 1, 10);
$faker->randomManyFloatNumbers(20, 1.0, 10.0);

//$faker->uuid();
/*$faker->date(
    date: '2021-01-01 00:00:04',
    addDays: 1,
    addHours: 2,
    addMinutes: 3,
    addSeconds: 4,
);*/


dump($faker);
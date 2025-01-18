<?php

require_once __DIR__ . '/vendor/autoload.php';

use ForgeBits\FabricaDeFakes\Core\FakerBase;
use ForgeBits\FabricaDeFakes\Generators\Strings\Letters\Formatters\CommaFormatter;

/*$fakerPack = \Faker\Factory::create('pt_BR');
$fakerPack->uuid();
dd($fakerPack);*/

$faker = new FakerBase();

$faker->uuid();
$faker->date();

$faker->randomInteger(1, 10);
$faker->randomIntegerExcept([1,2,3,4,5], 1, 10);

$faker->randomFloat(1.0, 10.0);

$faker->randomLetter(except: ['C'], upperCase: true);
$faker->randomLetters(formatterLetters: new CommaFormatter(), items: 25, except: ['C'], upperCase: false);
$faker->randomLettersBetween(formatterLetters: new CommaFormatter(), start: 'A', end: 'Z', items: 25, except: ['C'], upperCase: false);

$faker->randomManyIntegerNumbers(20, 1, 10);
$faker->randomManyIntegerNumbersExcept([1,2,3,4,5], 20, 1, 10);
$faker->randomManyFloatNumbers(20, 1.0, 10.0);

$faker->name(gender: 'female', surnames: 5);
$faker->maleName();
$faker->femaleName();
$faker->surname(2);

$faker->email();
$faker->emailWithoutDomain();
$faker->tld();
$faker->domain();

$faker->password(16, true, false, true, false, PASSWORD_BCRYPT, ['cost' => 12]);

dump($faker);
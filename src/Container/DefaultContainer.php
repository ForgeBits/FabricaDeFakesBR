<?php

namespace ForgeBits\FabricaDeFakes\Container;

use ForgeBits\FabricaDeFakes\Generators\Date\CarbonDate;
use ForgeBits\FabricaDeFakes\Generators\Date\DateGeneratorInterface;
use ForgeBits\FabricaDeFakes\Generators\Name\Name;
use ForgeBits\FabricaDeFakes\Generators\Name\NameInterface;
use ForgeBits\FabricaDeFakes\Generators\Numbers\RandomManyNumbers\RandomManyNumbers;
use ForgeBits\FabricaDeFakes\Generators\Numbers\RandomManyNumbers\RandomManyNumbersInterface;
use ForgeBits\FabricaDeFakes\Generators\Numbers\RandomNumbers\RandomNumber;
use ForgeBits\FabricaDeFakes\Generators\Numbers\RandomNumbers\RandomNumberInterface;
use ForgeBits\FabricaDeFakes\Generators\Strings\Letters\RandomLetter;
use ForgeBits\FabricaDeFakes\Generators\Strings\Letters\RandomLetterInterface;
use ForgeBits\FabricaDeFakes\Generators\UUID\RamseyUuidGenerator;
use ForgeBits\FabricaDeFakes\Generators\UUID\UuidGeneratorInterface;
use Psr\Container\ContainerInterface;

class DefaultContainer
{
    public static function createContainer(): ContainerInterface
    {
        $container = new Container();

        return $container
            ->set('uuidGenerator', function () use ($container) {
                return new RamseyUuidGenerator();
        }, UuidGeneratorInterface::class)
            ->set('dateGenerator', function () use ($container) {
                return new CarbonDate();
        }, DateGeneratorInterface::class)
            ->set('randomNumberGenerator', function () use ($container) {
                return new RandomNumber();
        }, RandomNumberInterface::class)
            ->set('randomManyNumbersGenerator', function () use ($container) {
                return new RandomManyNumbers();
        }, RandomManyNumbersInterface::class)
            ->set('randomLetterGenerator', function () use ($container) {
                return new RandomLetter();
        }, RandomLetterInterface::class)
            ->set('nameGenerator', function () use ($container) {
                return new Name();
        }, NameInterface::class);
    }
}
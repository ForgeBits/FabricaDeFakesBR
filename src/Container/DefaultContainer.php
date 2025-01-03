<?php

namespace ForgeBits\FabricaDeFakes\Container;

class DefaultContainer
{
    public static function createDefaultContainer(): Container
    {
        $container = new Container();

        $container->set('uuidGenerator', function () use ($container) {
            return new \ForgeBits\FabricaDeFakes\Generators\UUID\RamseyUuidGenerator();
        });

        $container->set('dateGenerator', function () use ($container) {
            return new \ForgeBits\FabricaDeFakes\Generators\Date\CarbonDate();
        });

        $container->set('randomNumberGenerator', function () use ($container) {
            return new \ForgeBits\FabricaDeFakes\Generators\Numbers\RandomNumbers\RandomNumber();
        });

        $container->set('randomManyNumbersGenerator', function () use ($container) {
            return new \ForgeBits\FabricaDeFakes\Generators\Numbers\RandomManyNumbers\RandomManyNumbers();
        });

        return $container;
    }

    public function createEmptyContainer(): Container
    {
        return new Container();
    }
}
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

        $container->set('randomDigitGenerator', function () use ($container) {
            return new \ForgeBits\FabricaDeFakes\Generators\Numbers\RandomDigit\RandomDigit();
        });

        return $container;
    }

    public function createEmptyContainer(): Container
    {
        return new Container();
    }
}
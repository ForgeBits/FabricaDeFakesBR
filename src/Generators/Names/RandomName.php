<?php

namespace ForgeBits\FabricaDeFakes\Generators\Names;

use ForgeBits\FabricaDeFakes\Core\Name;
use ForgeBits\FabricaDeFakes\Resources\Name as NameResource;

class RandomName implements RandomNameInterface
{
    /**
     * Gera um nome aleatorio podendo ser passado o genero e a quantidade de sobrenomes
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomName = $faker->randomName('male', 2)
     * </code>
     *
     * @param string|null $gender
     * @param int|null $surnames
     *
     * @return string
     */
    public function randomName(?string $gender = null, ?int $surnames = 0): string
    {
        $name = NameResource::getName($gender);
        $nameInstance = new Name($name);

        if ($surnames > 0) {
            $surname = NameResource::getSurname($surnames);
            $nameInstance->setSurname($surname);
        }

        return $nameInstance->getName();
    }

    /**
     * Gera um nome masculino aleatorio podendo ser passado a quantidade de sobrenomes
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomName = $faker->randomName(2)
     * </code>
     *
     * @param int|null $surnames
     *
     * @return string
     */
    public function randomMaleName(?int $surnames = 0): string
    {
        return $this->randomName('male', $surnames);
    }

    /**
     * Gera um nome feminino aleatorio podendo ser passado a quantidade de sobrenomes
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomName = $faker->randomName(2)
     * </code>
     *
     * @param int|null $surnames
     *
     * @return string
     */
    public function randomFemaleName(?int $surnames = 0): string
    {
        return $this->randomName('female', $surnames);
    }

    /**
     * Gera um sobrenome aleatorio podendo ser passado a quantidade de sobrenomes
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomName = $faker->randomSurname(2)
     * </code>
     *
     * @param int|null $surnames
     *
     * @return string
     */
    public function randomSurname(?int $surnames = 1): string
    {
        if ($surnames < 1) {
            throw new \InvalidArgumentException('The number of surnames must be greater than 0.');
        }

        return NameResource::getSurname($surnames);
    }
}
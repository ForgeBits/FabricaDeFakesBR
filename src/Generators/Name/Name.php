<?php

namespace ForgeBits\FabricaDeFakes\Generators\Name;

use ForgeBits\FabricaDeFakes\Core\Name as NameCore;

class Name implements NameInterface
{
    private HandleName $resource;

    public function __construct(HandleName $resource)
    {
        $this->resource = $resource;
    }

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
    public function name(?string $gender = null, ?int $surnames = 0): string
    {
        $name = $this->resource->getName($gender);
        $nameInstance = new NameCore($name);

        if ($surnames > 0) {
            $surname = $this->resource->getSurname($surnames);
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
    public function maleName(?int $surnames = 0): string
    {
        return $this->name('male', $surnames);
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
    public function femaleName(?int $surnames = 0): string
    {
        return $this->name('female', $surnames);
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
    public function surname(?int $surnames = 1): string
    {
        if ($surnames < 1) {
            throw new \InvalidArgumentException('The number of surnames must be greater than 0.');
        }

        return $this->resource->getSurname($surnames);
    }
}
<?php

namespace ForgeBits\FabricaDeFakes\Core;

use ForgeBits\FabricaDeFakes\Container\DefaultContainer;
use ForgeBits\FabricaDeFakes\Generators\Strings\Letters\Formatters\FormatterLetterInterface;
use Psr\Container\ContainerInterface;

class FakerBase
{
    protected ?ContainerInterface $c;
    protected array $data = [];

    public function __construct()
    {
        $this->c = DefaultContainer::createContainer();
    }

    public function __call(string $name, array $arguments)
    {
        if (method_exists($this, $name)) {
            return $this->$name(...$arguments);
        }

        throw new \BadMethodCallException("Método {$name} não existe.");
    }

    public function __get(string $name)
    {
        if (method_exists($this, $name)) {
            return $this->$name();
        }

        throw new \BadMethodCallException("Método {$name} não existe.");
    }

    /**
     * Obtém ou gera um UUID na versão 4.
     *
     * Este metodo verifica se o UUID já foi gerado anteriormente. Caso contrário,
     * utiliza o gerador de UUID registrado no container para criar um novo UUID.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $uuid = $faker->uuid();
     * </code>
     *
     * @return string O UUID gerado ou previamente armazenado.
     */
    public function uuid(): string
    {
        if (empty($this->data['uuid'])) {
            $this->data['uuid'] = $this->c->get('uuidGenerator')->generateUuid4();
        }

        return $this->data['uuid'];
    }

    /**
     * Gera uma data com base nos parâmetros informados.
     *
     * Este metodo verifica se a data já foi gerada anteriormente. Caso contrário, uma nova data é gerada.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $date = $faker->date(
     *       date: '2021-01-01 00:00:04',
     *       addDays: 1,
     *       addHours: 2,
     *       addMinutes: 3,
     *       addSeconds: 4,
     *    );
     *
     * @param string|null $date Data base para a geração da nova data.
     * @param string|null $timezone Fuso horário da data gerada.
     * @param int|null $addDays Quantidade de dias a serem adicionados à data.
     * @param int|null $addHours Quantidade de horas a serem adicionadas à data.
     * @param int|null $addMinutes Quantidade de minutos a serem adicionados à data.
     * @param int|null $addSeconds Quantidade de segundos a serem adicionados à data.
     * @param bool|null $withHours Indica se a data gerada deve conter as horas.
     *
     * @return string A data gerada ou previamente armazenada.
     *
     */
    public function date(
        ?string $date = null,
        ?string $timezone = 'GMT-3',
        ?int $addDays = 0,
        ?int $addHours = 0,
        ?int $addMinutes = 0,
        ?int $addSeconds = 0,
        ?bool $withHours = true
    ): string
    {
        if (empty($this->data['date'])) {
            $this->data['date'] = $this->c->get('dateGenerator')->generateDate(
                $date,
                $timezone,
                $addDays,
                $addHours,
                $addMinutes,
                $addSeconds,
                $withHours
            );
        }
        return $this->data['date'];
    }

    /**
     * Gera um número aleatório entre os valores informados.
     *
     * Este metodo verifica se o número já foi gerado anteriormente. Caso contrário, um novo número é gerado.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomDigit = $faker->randomDigit(0, 100);
     * </code>
     *
     * @param int|null $min Valor mínimo do número gerado.
     * @param int|null $max Valor máximo do número gerado.
     *
     * @return int O número gerado ou previamente armazenado.
     */
    public function randomInteger(?int $min = 0, ?int $max = PHP_INT_MAX): int
    {
        if (empty($this->data['randomInteger'])) {
            $this->data['randomInteger'] = $this->c->get('randomNumberGenerator')->randomInteger($min, $max);
        }

        return $this->data['randomInteger'];
    }

    /**
     * Gera um número aleatório entre os valores informados, exceto os valores informados no array $except.
     *
     * Este metodo verifica se o número já foi gerado anteriormente. Caso contrário, um novo número é gerado.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomDigit = $faker->randomDigitExcept([1,2,3,4,5], 1, 10);
     * </code>
     *
     * @param array $except Valores que não podem ser gerados.
     * @param int|null $min Valor mínimo do número gerado.
     * @param int|null $max Valor máximo do número gerado.
     *
     * @return int O número gerado ou previamente armazenado.
     */
    public function randomIntegerExcept(array $except, ?int $min = 0, ?int $max = PHP_INT_MAX): int
    {
        if (empty($this->data['randomIntegerExcept'])) {
            $this->data['randomIntegerExcept'] = $this->c->get('randomNumberGenerator')->randomIntegerExcept($except, $min, $max);
        }

        return $this->data['randomIntegerExcept'];
    }

    /**
     * Gera um número do tipo float aleatório entre os valores informados.
     *
     * Este metodo verifica se o número já foi gerado anteriormente. Caso contrário, um novo número é gerado.
     * <code>
     *     $faker = new FakerBase();
     *     $randomFloat = $faker->randomFloat(1.0, 10.0);
     * </code>
     *
     * @param float|null $min Valor mínimo do número gerado.
     * @param float|null $max Valor máximo do número gerado.
     *
     * @return float O número gerado ou previamente armazenado.
     *
     */
    public function randomFloat(?float $min = 0.0, ?float $max = PHP_FLOAT_MAX): float
    {
        if (empty($this->data['randomFloat'])) {
            $this->data['randomFloat'] = $this->c->get('randomNumberGenerator')->randomFloat($min, $max);
        }

        return $this->data['randomFloat'];
    }

    /**
     * Gera um array com números inteiros aleatórios entre os valores informados.
     *
     * Este metodo verifica se o array de números já foi gerado anteriormente. Caso contrário, um novo array é gerado.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomInteger = $faker->randomManyIntegerNumbers(10, 1, 10);
     * </code>
     *
     * @param int $items Quantidade de números a serem gerados.
     * @param int|null $min Valor mínimo do número gerado.
     * @param int|null $max Valor máximo do número gerado.
     *
     * @return array Um array com os números gerados.
     */
    public function randomManyIntegerNumbers(int $items = 10, ?int $min = 0, ?int $max = PHP_INT_MAX): array
    {
        if (empty($this->data['randomManyIntegerNumbers'])) {
            $this->data['randomManyIntegerNumbers'] = $this->c->get('randomManyNumbersGenerator')->randomManyIntegerNumbers($items, $min, $max);
        }

        return $this->data['randomManyIntegerNumbers'];
    }

    /**
     * Gera um array com números inteiros aleatórios entre os valores informados, exceto os valores informados no array $except.
     *
     * Este metodo verifica se o array de números já foi gerado anteriormente. Caso contrário, um novo array é gerado.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomInteger = $faker->randomManyIntegerNumbersExcept([1,2,3,4,5], 10, 1, 10);
     * </code>
     *
     * @param array $except Valores que não podem ser gerados.
     * @param int $items Quantidade de números a serem gerados.
     * @param int|null $min Valor mínimo do número gerado.
     * @param int|null $max Valor máximo do número gerado.
     *
     * @return array Um array com os números gerados.
     */
    public function randomManyIntegerNumbersExcept(array $except, int $items, ?int $min = 0, ?int $max = PHP_INT_MAX): array
    {
        if (empty($this->data['randomManyIntegerNumbersExcept'])) {
            $this->data['randomManyIntegerNumbersExcept'] = $this->c->get('randomManyNumbersGenerator')->randomManyIntegerNumbersExcept($except, $items, $min, $max);
        }

        return $this->data['randomManyIntegerNumbersExcept'];
    }

    /**
     * Gera um array com números do tipo float aleatórios entre os valores informados.
     *
     * Este metodo verifica se o array de números já foi gerado anteriormente. Caso contrário, um novo array é gerado.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomFloat = $faker->randomManyFloatNumbers(10, 1.0, 10.0);
     * </code>
     *
     * @param int $items Quantidade de números a serem gerados.
     * @param float|null $min Valor mínimo do número gerado.
     * @param float|null $max Valor máximo do número gerado.
     *
     * @return array Um array com os números gerados.
     */
    public function randomManyFloatNumbers(int $items = 10, ?float $min = 0.0, ?float $max = PHP_FLOAT_MAX): array
    {
        if (empty($this->data['randomManyFloatNumbers'])) {
            $this->data['randomManyFloatNumbers'] = $this->c->get('randomManyNumbersGenerator')->randomManyFloatNumbers($items, $min, $max);
        }

        return $this->data['randomManyFloatNumbers'];
    }

    /**
     * Gera uma letra aleatória.
     *
     * Este metodo verifica se a letra já foi gerada anteriormente. Caso contrário, uma nova letra é gerada.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomLetter = $faker->randomLetter(except: ['C'], upperCase: true);
     * </code>
     *
     * @param array|null $except Letras que não podem ser geradas.
     * @param bool|null $upperCase Indica se a letra gerada deve ser maiúscula.
     *
     * @return string A letra gerada ou previamente armazenada.
     */
    public function randomLetter(?array $except = [], ?bool $upperCase = false): string
    {
        if (empty($this->data['randomLetter'])) {
            $this->data['randomLetter'] = $this->c->get('randomLetterGenerator')->randomLetter($except, $upperCase);
        }

        return $this->data['randomLetter'];
    }

    /**
     * Gera um array com letras aleatórias.
     *
     * Este metodo verifica se o array de letras já foi gerado anteriormente. Caso contrário, um novo array é gerado.
     *
     * <code>
     *      $faker = new FakerBase();
     *      $randomLetters = $faker->randomLetters(formatterLetters: new ArrayFormatter(), items: 25, except: ['C'], upperCase: true);
     * </code>
     *
     * @param FormatterLetterInterface $formatterLetters
     * @param int $items Quantidade de letras a serem geradas.
     * @param array|null $except Letras que não podem ser geradas.
     * @param bool|null $upperCase Se as letras geradas devem ser maiúsculas.
     *
     * @return array|string Um array ou string com as letras geradas no formato informado.
     */
    public function randomLetters(FormatterLetterInterface $formatterLetters, int $items = 10, ?array $except = [], ?bool $upperCase = false): array|string
    {
        if (empty($this->data['randomLetters'])) {
            $this->data['randomLetters'] = $this->c->get('randomLetterGenerator')->randomLetters($formatterLetters, $items, $except, $upperCase);
        }

        return $this->data['randomLetters'];
    }

    /**
     * Gera um array com letras aleatórias entre os valores informados.
     *
     * Este metodo verifica se o array de letras já foi gerado anteriormente. Caso contrário, um novo array é gerado.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomLetters = $faker->randomLettersBetween(formatterLetters: new ArrayFormatter(), start: 'A', end: 'Z', items: 25, except: ['C'], upperCase: true);
     * </code>
     *
     * @param FormatterLetterInterface $formatterLetters
     * @param string $start Letra inicial do intervalo.
     * @param string $end Letra final do intervalo.
     * @param int $items Quantidade de letras a serem geradas.
     * @param array|null $except Letras que não podem ser geradas.
     * @param bool|null $upperCase Se as letras geradas devem ser maiúsculas.
     *
     * @return array|string Um array ou string com as letras geradas no formato informado.
     */
    public function randomLettersBetween(FormatterLetterInterface $formatterLetters, string $start, string $end, int $items, ?array $except = [], ?bool $upperCase = false): array|string
    {
        if (empty($this->data['randomLettersBetween'])) {
            $this->data['randomLettersBetween'] = $this->c->get('randomLetterGenerator')->randomLettersBetween($formatterLetters, $start, $end, $items, $except, $upperCase);
        }

        return $this->data['randomLettersBetween'];
    }

    /**
     * Gera um nome aleatorio podendo ser passado o genero e a quantidade de sobrenomes
     *
     *  Este metodo verifica se o array de letras já foi gerado anteriormente. Caso contrário, um novo array é gerado.
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
    public function randomName(?string $gender = null, ?int $surnames = 0): string {
        if (empty($this->data['randomName'])) {
            $this->data['randomName'] = $this->c->get('randomNameGenerator')->randomName($gender, $surnames);
        }

        return $this->data['randomName'];
    }

    /**
     * Gera um nome masculino aleatorio podendo ser passado a quantidade de sobrenomes
     *
     * Este metodo verifica se o array de letras já foi gerado anteriormente. Caso contrário, um novo array é gerado.
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
        if (empty($this->data['randomMaleName'])) {
            $this->data['randomMaleName'] = $this->c->get('randomNameGenerator')->randomMaleName($surnames);
        }

        return $this->data['randomMaleName'];
    }

    /**
     * Gera um nome feminino aleatorio podendo ser passado a quantidade de sobrenomes
     *
     * Este metodo verifica se o array de letras já foi gerado anteriormente. Caso contrário, um novo array é gerado.
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
        if (empty($this->data['randomFemaleName'])) {
            $this->data['randomFemaleName'] = $this->c->get('randomNameGenerator')->randomFemaleName($surnames);
        }

        return $this->data['randomFemaleName'];
    }

    /**
     * Gera um sobrenome aleatorio
     *
     * Este metodo verifica se o array de letras já foi gerado anteriormente. Caso contrário, um novo array é gerado.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $randomSurname = $faker->randomSurname(1)
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

        if (empty($this->data['randomSurname'])) {
            $this->data['randomSurname'] = $this->c->get('randomNameGenerator')->randomSurname($surnames);
        }

        return $this->data['randomSurname'];
    }
}
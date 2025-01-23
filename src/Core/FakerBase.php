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
            $this->data['uuid'] = $this->c->get('uuidGenerator')->uuid4();
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
    public function name(?string $gender = null, ?int $surnames = 0): string
    {
        if (empty($this->data['name'])) {
            $this->data['name'] = $this->c->get('nameGenerator')->name($gender, $surnames);
        }

        return $this->data['name'];
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
    public function maleName(?int $surnames = 0): string
    {
        if (empty($this->data['maleName'])) {
            $this->data['maleName'] = $this->c->get('nameGenerator')->maleName($surnames);
        }

        return $this->data['maleName'];
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
    public function femaleName(?int $surnames = 0): string
    {
        if (empty($this->data['femaleName'])) {
            $this->data['femaleName'] = $this->c->get('nameGenerator')->femaleName($surnames);
        }

        return $this->data['femaleName'];
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
    public function surname(?int $surnames = 1): string
    {
        if (empty($this->data['surname'])) {
            $this->data['surname'] = $this->c->get('nameGenerator')->surname($surnames);
        }

        return $this->data['surname'];
    }

    /**
     * Gera um email aleatorio
     *
     * Este metodo verifica o email já foi gerado anteriormente. Caso contrário, um novo email é gerado.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $email = $faker->email();
     * </code>
     *
     * @param string|null $username
     * @param string|null $domain
     * @param string|null $tld
     *
     * @return string
     */
    public function email(?string $username = null, ?string $domain = null, ?string $tld = null): string
    {
        if (empty($this->data['email'])) {
            $this->data['email'] = $this->c->get('emailGenerator')->email($username, $domain, $tld);
        }

        return $this->data['email'];
    }

    /**
     * Gera um email aleatorio sem o dominio
     *
     * Este metodo verifica o email sem o domínio já foi gerado anteriormente. Caso contrário, um novo email é gerado.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $emailWithoutDomain = $faker->emailWithoutDomain();
     * </code>
     *
     * @param string|null $username
     *
     * @return string
     */
    public function emailWithoutDomain(?string $username = null): string
    {
        if (empty($this->data['emailWithoutDomain'])) {
            $this->data['emailWithoutDomain'] = $this->c->get('emailGenerator')->emailWithoutDomain($username);
        }

        return $this->data['emailWithoutDomain'];
    }

    /**
     * Gera um tld aleatorio sem o dominio e o tld
     *
     * Este metodo verifica se o tld já foi gerado anteriormente. Caso contrário, um novo tld é gerado.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $emailWithoutDomainAndTld = $faker->tld();
     * </code>
     *
     * @return string
     */
    public function tld(): string
    {
        if (empty($this->data['tld'])) {
            $this->data['tld'] = $this->c->get('emailGenerator')->tld();
        }

        return $this->data['tld'];
    }

    /**
     * Gera um dominio aleatorio.
     *
     * Este metodo verifica se o domínio já foi gerado anteriormente. Caso contrário, um novo domínio é gerado.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $emailWithoutDomainAndTld = $faker->domain();
     * </code>
     *
     * @return string
     */
    public function domain(): string
    {
        if (empty($this->data['domain'])) {
            $this->data['domain'] = $this->c->get('emailGenerator')->domain();
        }

        return $this->data['domain'];
    }

    /**
     * Gera uma senha aleatória.
     *
     * Este metodo verifica se a senha já foi gerada anteriormente. Caso contrário, uma nova senha é gerada.
     *
     * <code>
     *     $faker = new FakerBase();
     *     $password = $faker->password(16, true, false, true, false, PASSWORD_BCRYPT, ['cost' => 12]);
     * </code>
     *
     * @param int $length Tamanho da senha.
     * @param bool|null $upperCase Indica se a senha deve conter letras maiúsculas.
     * @param bool|null $lowerCase Indica se a senha deve conter letras minúsculas.
     * @param bool|null $numbers Indica se a senha deve conter números.
     * @param bool|null $specialCaracteres Indica se a senha deve conter caracteres especiais.
     * @param string|null $encrypt Algoritmo de criptografia da senha.
     * @param array|null $options Opções para o algoritmo de criptografia.
     *
     * @return string A senha gerada ou previamente armazenada.
     */
    public function password(
        int $length = 8,
        ?bool $upperCase = true,
        ?bool $lowerCase = true,
        ?bool $numbers = true,
        ?bool $specialCaracteres = true,
        ?string $passwordHash = null,
        ?array $options = []
    ): string {
        if (empty($this->data['password'])) {
            $this->data['password'] = $this->c->get('passwordGenerator')->password(
                $length,
                $upperCase,
                $lowerCase,
                $numbers,
                $specialCaracteres,
                $passwordHash,
                $options,
            );
        }
        return $this->data['password'];
    }

    public function hexadecimalColor(): string
    {
        if (empty($this->data['hexadecimalColor'])) {
            $this->data['hexadecimalColor'] = $this->c->get('colorGenerator')->hexadecimalColor();
        }

        return $this->data['hexadecimalColor'];
    }
}
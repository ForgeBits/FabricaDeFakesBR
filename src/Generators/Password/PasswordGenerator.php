<?php

namespace ForgeBits\FabricaDeFakes\Generators\Password;

use ForgeBits\FabricaDeFakes\Core\Password;

class PasswordGenerator implements PasswordGeneratorInterface
{
    /**
     * Gera uma senha aleatória.
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
     * @param string|null $passwordHash Algoritmo de criptografia da senha.
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
        $passwordCore = new Password();

        if ($upperCase) {
            $passwordCore->enableUpperCaseCaracters();
        }

        if ($lowerCase) {
            $passwordCore->enableLowerCaseCaracters();
        }

        if ($numbers) {
            $passwordCore->enableNumbers();
        }

        if ($specialCaracteres) {
            $passwordCore->enableSpecialCaracters();
        }

        $passwordCore->generate($length);

        return $passwordCore->password($passwordHash, $options);
    }
}
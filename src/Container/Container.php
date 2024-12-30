<?php

namespace ForgeBits\FabricaDeFakes\Container;

use Exception;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class Container implements ContainerInterface
{
    private array $services = [];

    public function set(string $id, $service): void
    {
        $this->services[$id] = $service;
    }

    /**
     * Obtém um serviço do container.
     * @param string $id
     * @return mixed
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function get(string $id)
    {
        if (!$this->has($id)) {
            throw new Exception("Service not found: $id");
        }

        $service = $this->services[$id];

        return is_callable($service) ? $service() : $service;
    }

    /**
     * Verifica se um serviço está registrado no container.
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        return isset($this->services[$id]);
    }
}
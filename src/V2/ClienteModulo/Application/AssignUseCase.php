<?php

namespace Src\V2\ClienteModulo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\ClienteModulo\Domain\Contracts\ClienteModuloRepositoryContract;

final class AssignUseCase
{
    /**
     * @var ClienteModuloRepositoryContract
     */
    private ClienteModuloRepositoryContract $repository;

    public function __construct( ClienteModuloRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCliente,
        array $modulos,
        string $idUsuario
    ): void
    {
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_modulos = $modulos;
        $_idUsuario = new Id($idUsuario,false,'El id del usuario no tiene el formato correcto');

        $this->repository->assign(
            $_idCliente,
            $_modulos,
            $_idUsuario
        );

    }
}

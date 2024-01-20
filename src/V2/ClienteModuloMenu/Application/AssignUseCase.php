<?php

namespace Src\V2\ClienteModuloMenu\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\ClienteModuloMenu\Domain\Contracts\ClienteModuloMenuRepositoryContract;

final class AssignUseCase
{
    /**
     * @var ClienteModuloMenuRepositoryContract
     */
    private ClienteModuloMenuRepositoryContract $repository;

    public function __construct( ClienteModuloMenuRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCliente,
        int $idModulo,
        array $menu,
        string $idUsuario
    ): void
    {
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idModulo = new NumericInteger($idModulo);
        $_menu = $menu;
        $_idUsuario = new Id($idUsuario,false,'El id del usuario no tiene el formato correcto');

        $this->repository->assign(
            $_idCliente,
            $_idModulo,
            $_menu,
            $_idUsuario
        );
    }
}

<?php

namespace Src\V2\Empresa\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Empresa\Domain\Contracts\EmpresaRepositoryContract;

final class ChangePredeterminadoUseCase
{
    /**
     * @var EmpresaRepositoryContract
     */
    private EmpresaRepositoryContract $repository;

    public function __construct( EmpresaRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCliente,
        string $idEmpresa,
        string $idUsuarioRegistro
    ): void
    {
        $_idEmpresa = new Id($idEmpresa,false,'El id de la empresa no tiene el formato correcto');
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->changePredeterminado(
            $_idCliente,
            $_idEmpresa,
            $_idUsuarioRegistro
        );

    }
}

<?php

namespace Src\V2\Empresa\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Empresa\Domain\Contracts\EmpresaRepositoryContract;

final class ChangeStateUseCase
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
        string $idEmpresa,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idEmpresa = new Id($idEmpresa,false,'El id de la empresa no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idEmpresa,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}

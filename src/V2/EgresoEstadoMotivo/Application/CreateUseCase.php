<?php

namespace Src\V2\EgresoEstadoMotivo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\EgresoEstadoMotivo\Domain\Contracts\EgresoEstadoMotivoRepositoryContract;

final class CreateUseCase
{
    /**
     * @var EgresoEstadoMotivoRepositoryContract
     */
    private EgresoEstadoMotivoRepositoryContract $repository;

    public function __construct( EgresoEstadoMotivoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCliente,
        string $idEgreso,
        int $idEgresoMotivo,
        string $idUsuarioRegistro
    ): void
    {

        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idEgreso = new Id($idEgreso,false, 'El id del ingreso no tiene el formato correcto');
        $_motivo = new NumericInteger($idEgresoMotivo);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false, 'El id del cliente no tiene el formato correcto');


        $this->repository->create(
            $_idCliente,
            $_idEgreso,
            $_motivo,
            $_idUsuarioRegistro
        );

    }
}

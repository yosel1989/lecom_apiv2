<?php

namespace Src\V2\EgresoDetalle\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\EgresoDetalle\Domain\Contracts\EgresoDetalleRepositoryContract;

final class LiberarLiquidacionEgresoDetalleUseCase
{
    /**
     * @var EgresoDetalleRepositoryContract
     */
    private EgresoDetalleRepositoryContract $repository;

    public function __construct( EgresoDetalleRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCliente,
        string $idLiquidacion,
        string $idUsuarioRegistro
    ): void
    {

        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idLiquidacion = new Id($idLiquidacion,false, 'El id del egreso no tiene el formato correcto');
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false, 'El id del usuario no tiene el formato correcto');


        $this->repository->liberarLiquidacionDetalle(
            $_idCliente,
            $_idLiquidacion,
            $_idUsuarioRegistro
        );

    }
}

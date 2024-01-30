<?php

namespace Src\V2\EgresoDetalle\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\V2\EgresoDetalle\Domain\Contracts\EgresoDetalleRepositoryContract;

final class CreateUseCase
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
        string $idEgreso,
        string $idCliente,
        string $idEgresoTipo,
        string $fecha,
        float $importe,
        string $idUsuarioRegistro
    ): void
    {
        $_idEgreso = new Id($idEgreso,false, 'El id del egreso no tiene el formato correcto');
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idEgresoTipo = new Id($idEgresoTipo,false, 'El id del egreso tipo no tiene el formato correcto');
        $_fecha = new DateFormat($fecha,false,'La fecha no tiene el formato correcto');
        $_importe = new NumericFloat($importe);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->create(
            $_idEgreso,
            $_idCliente,
            $_idEgresoTipo,
            $_fecha,
            $_importe,
            $_idUsuarioRegistro
        );

    }
}

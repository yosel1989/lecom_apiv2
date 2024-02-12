<?php

namespace Src\V2\EgresoDetalle\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\EgresoDetalle\Domain\Contracts\EgresoDetalleRepositoryContract;
use Src\V2\EgresoDetalle\Domain\EgresoDetalle;

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
        string $id,
        string $idEgreso,
        string $idCliente,
        string $idEgresoTipo,
        ?string $detalle,
        string $fecha,
        float $importe,
        ?string $numeroDocumento,
        string $idUsuarioRegistro
    ): EgresoDetalle
    {
        $_id = new Id($id,false, 'El id no tiene el formato correcto');
        $_idEgreso = new Id($idEgreso,false, 'El id del egreso no tiene el formato correcto');
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idEgresoTipo = new Id($idEgresoTipo,false, 'El id del egreso tipo no tiene el formato correcto');
        $_detalle = new Text($detalle,true, 150, 'El detalle excede los 150 caracteres');
        $_fecha = new DateFormat($fecha,false,'La fecha no tiene el formato correcto');
        $_importe = new NumericFloat($importe);
        $_numeroDocumento = new Text($numeroDocumento,true, 50, 'El numero de documento excede los 50 caracteres');
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        return $this->repository->create(
            $_id,
            $_idEgreso,
            $_idCliente,
            $_idEgresoTipo,
            $_detalle,
            $_fecha,
            $_importe,
            $_numeroDocumento,
            $_idUsuarioRegistro
        );

    }
}

<?php

namespace Src\V2\Ingreso\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\Ingreso\Domain\Contracts\IngresoRepositoryContract;
use Src\V2\Ingreso\Domain\Ingreso;

final class CreateUseCase
{
    /**
     * @var IngresoRepositoryContract
     */
    private IngresoRepositoryContract $repository;

    public function __construct( IngresoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $idCliente,
        string $idSede,
        ?string $idVehiculo,
        ?string $idPersonal,
        float $total,
        string $idCaja,
        string $idCajaDiario,
        string $idUsuarioRegistro
    ): Ingreso
    {

        $id = new Id $id,
        $idCliente = new Id $idCliente,
        $idSede = new Id $idSede,
        $idTipoComprobante = new NumericInteger $idTipoComprobante,
        $serie = new Text $serie,
        $numero = new NumericInteger $numero,
        $idTipoIngreso = new NumericInteger $idTipoIngreso,
        $detalle = new Text $detalle,
        $idTipoDocumentoEntidad = new NumericInteger $idTipoDocumentoEntidad,
        $numeroDocumentoEntidad = new Text $numeroDocumentoEntidad,
        $nombreEntidad = new Text $nombreEntidad,
        $importe = new NumericFloat $importe,
        $idCaja = new Id $idCaja,
        $idCajaDiario = new Id $idCajaDiario,
        $contabilizado = new ValueBoolean $contabilizado,
        $aprobado = new ValueBoolean $aprobado,
        $idMedioPago = new NumericInteger $idMedioPago,
        $numeroOperacion = new Text $numeroOperacion,
        $idEntidadFinanciera = new NumericInteger $idEntidadFinanciera,
        $idUsuarioRegistro = new Id $idUsuarioRegistro

        return $this->repository->create(
            $_id,
            $_idCliente,
            $_idSede,
            $_idVehiculo,
            $_idPersonal,
            $_total,
            $_idCaja,
            $_idCajaDiario,
            $_idUsuarioRegistro
        );

    }
}

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
        int $idTipoComprobante,
        string $idTipoIngreso,
        ?string $detalle,
        int $idTipoDocumentoEntidad,
        string $numeroDocumentoEntidad,
        string $nombreEntidad,
        float $importe,
        string $idCaja,
        string $idCajaDiario,
        bool $ccontabilizado,
        bool $aprobado,
        bool $revisado,
        int $idMedioPago,
        ?string $numeroOperacion,
        ?int $idEntidadFinanciera,
        string $idUsuarioRegistro
    ): Ingreso
    {

        $_id = new Id($id, false, 'El id del ingreso no tiene el formato correcto');
        $_idCliente = new Id($idCliente, false,  'El id del cliente no tiene el formato correcto');
        $_idSede = new Id($idSede, false, 'El id de la sede no tiene el formato correcto');
        $_idTipoComprobante = new NumericInteger($idTipoComprobante);
        $_idTipoIngreso = new Id($idTipoIngreso, false, 'El id del tipo de ingreso no tiene el formato correcto');
        $_detalle = new Text($detalle, true, 250, 'El detalle excede los 250 caracteres');
        $_idTipoDocumentoEntidad = new NumericInteger($idTipoDocumentoEntidad);
        $_numeroDocumentoEntidad = new Text($numeroDocumentoEntidad,false, 25, 'El numero de documento de la entidad exede los 25 caracteres');
        $_nombreEntidad = new Text($nombreEntidad, false, 150, 'El nombre de la entidad excede los 150 caracteres');
        $_importe = new NumericFloat($importe);
        $_idCaja = new Id($idCaja, false,  'El id de la caja no tiene el formato correcto');
        $_idCajaDiario = new Id($idCajaDiario, false,  'El id del diario de caja no tiene el formato correcto');
        $_contabilizado = new ValueBoolean($ccontabilizado);
        $_aprobado = new ValueBoolean($aprobado);
        $_revisado = new ValueBoolean($revisado);
        $_idMedioPago = new NumericInteger($idMedioPago);
        $_numeroOperacion = new Text($numeroOperacion, true, 25, 'El número de operación excede los 25 caracteres');
        $_idEntidadFinanciera = new NumericInteger($idEntidadFinanciera, true);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro, false,  'El id del usuario que registro no tiene el formato correcto');

        return $this->repository->create(
             $_id,
             $_idCliente,
             $_idSede,
             $_idTipoComprobante,
             $_idTipoIngreso,
             $_detalle,
             $_idTipoDocumentoEntidad,
             $_numeroDocumentoEntidad,
             $_nombreEntidad,
             $_importe,
             $_idCaja,
             $_idCajaDiario,
             $_contabilizado,
             $_aprobado,
             $_revisado,
             $_idMedioPago,
             $_numeroOperacion,
             $_idEntidadFinanciera,
             $_idUsuarioRegistro
        );

    }
}

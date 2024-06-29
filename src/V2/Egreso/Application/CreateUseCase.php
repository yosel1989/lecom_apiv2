<?php

namespace Src\V2\Egreso\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Egreso\Domain\Contracts\EgresoRepositoryContract;
use Src\V2\Egreso\Domain\Egreso;

final class CreateUseCase
{
    /**
     * @var EgresoRepositoryContract
     */
    private EgresoRepositoryContract $repository;

    public function __construct( EgresoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        int $idOrigen,
        string $idCliente,
        int $idTipoComprobante,
//        string $serie,
//        int $numero,
        string $idCategoria,
        string $idTipo,
        ?string $detalle,
        int $idTipoDocumentoEntidad,
        string $numeroDocumentoEntidad,
        string $nombreEntidad,
        string $idSede,
        float $monto,
        int $idMedioPago,
        ?string $idVehiculo,
        ?string $idPersonal,
        string $idCaja,
        string $idCajaDiario,
        string $fecha,
        string $idUsuarioRegistro
    ): Egreso
    {

        $_id = new Id($id,false, 'El id del egreso no tiene el formato correcto');
        $_idOrigen = new NumericInteger($idOrigen);
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idTipoComprobante = new NumericInteger($idTipoComprobante);
//        $_serie = new Text($serie, false, -1, '');
//        $_numero = new NumericInteger($numero, false, -1, '');
        $_idCategoria = new Id($idCategoria,false,'El id de la categoria no tiene el formato correcto');
        $_idTipo = new Id($idTipo,false,'El id del tipo no tiene el formato correcto');
        $_detalle = new Text($detalle, false, 250, 'El detalle excede los 250 caracteres');
        $_idTipoDocumentoEntidad = new NumericInteger($idTipoDocumentoEntidad);
        $_numeroDocumentoEntidad = new Text($numeroDocumentoEntidad, false, -1, '');
        $_nombreEntidad = new Text($nombreEntidad, false, -1, '');
        $_idSede = new Id($idSede,false,'El id de la sede no tiene el formato correcto');
        $_monto = new NumericFloat($monto);
        $_idMedioPago = new NumericInteger($idMedioPago);
        $_idVehiculo = new Id($idVehiculo,true,'El id del vehiculo no tiene el formato correcto');
        $_idPersonal = new Id($idPersonal,true,'El id del personal no tiene el formato correcto');
        $_idCaja = new Id($idCaja,false,'El id de la caja no tiene el formato correcto');
        $_idCajaDiario = new Id($idCajaDiario,false,'El id de la caja diario no tiene el formato correcto');
        $_fecha = new DateFormat($fecha,false,'La fecha no tiene el formato correcto');
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        return $this->repository->create(
            $_id,
            $_idOrigen,
            $_idCliente,
            $_idTipoComprobante,
//            $_serie,
//            $_numero,
            $_idCategoria,
            $_idTipo,
            $_detalle,
            $_idTipoDocumentoEntidad,
            $_numeroDocumentoEntidad,
            $_nombreEntidad,
            $_idSede,
            $_monto,
            $_idMedioPago,
            $_idVehiculo,
            $_idPersonal,
            $_idCaja,
            $_idCajaDiario,
            $_fecha,
            $_idUsuarioRegistro
        );

    }
}

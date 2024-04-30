<?php

declare(strict_types=1);

namespace Src\V2\BoletoInterprovincial\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialOficial;
use Src\V2\BoletoInterprovincial\Domain\Contracts\BoletoInterprovincialRepositoryContract;

final class PuntoVentaUseCase
{
    private BoletoInterprovincialRepositoryContract $repository;

    public function __construct(BoletoInterprovincialRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(

        string $id,

        string $idCliente,
        string $idSede,
        string $idCaja,
        string $idCajaDiario,
        int $idTipoDocumento,
        string $numeroDocumento,
        string $nombres,
        string $apellidos,
        int $menorEdad,


        ?string $idVehiculo,
        ?string $idAsiento,
        ?string $fechaPartida,
        ?string $horaPartida,
        string $idRuta,
        string $idBoletoPrecio,
        float $precio,
        int $idTipoMoneda,
        int $idFormaPago,
        int $idMedioPago,
        int $obsequio,

        string $idEmpresa,
        int $idTipoComprobante,
        string $idSerie,
        bool $editarEntidad,
        ?int $idTipoDocumentoEntidad,
        ?string $numeroDocumentoEntidad,
        ?string $nombreEntidad,
        ?string $direccionEntidad,
        string $idUsuarioRegistro
    ): BoletoInterprovincialOficial
    {
        $_id = new Id($id,false, 'El id no tiene el formato correcto');

        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idSede = new Id($idSede,false, 'El id de la sede no tiene el formato correcto');
        $_idCaja = new Id($idCaja,false, 'El id de la caja no tiene el formato correcto');
        $_idCajaDiario = new Id($idCajaDiario,false, 'El id de la caja diario no tiene el formato correcto');
        $_idTipoDocumento = new NumericInteger($idTipoDocumento);
        $_numeroDocumento = new Text($numeroDocumento,false, -1, '');
        $_nombres = new Text($nombres,false, -1, '');
        $_apellidos = new Text($apellidos,false, -1, '');
        $_menorEdad = new NumericInteger($menorEdad);


        $_idVehiculo = new Id($idVehiculo,true, 'El id del vehiculo no tiene el formato correcto');
        $_idAsiento = new Id($idAsiento,true, 'El id del asiento no tiene el formato correcto');
        $_fechaPartida = new DateFormat($fechaPartida,true, 'El formato de la fecha no es la correcta');
        $_horaPartida = new DateFormat($horaPartida,true, 'El formato de la hora no es la correcta');
        $_idRuta = new Id($idRuta,false, 'El id de la ruta no tiene el formato correcto');
        $_idBoletoPrecio = new Id($idBoletoPrecio,false, 'El id del precio no tiene el formato correcto');
        $_precio = new NumericFloat($precio);
        $_idTipoMoneda = new NumericInteger($idTipoMoneda);
        $_idFormaPago = new NumericInteger($idFormaPago);
        $_idMedioPago = new NumericInteger($idMedioPago);
        $_obsequio = new NumericInteger($obsequio);

        $_idEmpresa = new Id($idEmpresa,false, 'El id de la empresa no tiene el formato correcto');
        $_idTipoComprobante = new NumericInteger($idTipoComprobante);
        $_idSerie = new Id($idSerie,false, 'El id de la serie no tiene el formato correcto');
        $_editarEntidad = new ValueBoolean($editarEntidad);
        $_idTipoDocumentoEntidad = new NumericInteger($idTipoDocumentoEntidad);
        $_numeroDocumentoEntidad = new Text($numeroDocumentoEntidad,true, -1, '');
        $_nombreEntidad = new Text($nombreEntidad,true, -1, '');
        $_direccionEntidad = new Text($direccionEntidad,true, -1, '');

        $_idUsuario = new Id($idUsuarioRegistro,false, 'El id del usuario no tiene el formato correcto');

        return $this->repository->puntoVenta(
            $_id,

            $_idCliente,
            $_idSede,
            $_idCaja,
            $_idCajaDiario,
            $_idTipoDocumento,
            $_numeroDocumento,
            $_nombres,
            $_apellidos,
            $_menorEdad,


            $_idVehiculo,
            $_idAsiento,
            $_fechaPartida,
            $_horaPartida,
            $_idRuta,
            $_idBoletoPrecio,
            $_precio,
            $_idTipoMoneda,
            $_idFormaPago,
            $_idMedioPago,
            $_obsequio,

            $_idEmpresa,
            $_idTipoComprobante,
            $_idSerie,
            $_editarEntidad,
            $_idTipoDocumentoEntidad,
            $_numeroDocumentoEntidad,
            $_nombreEntidad,
            $_direccionEntidad,

            $_idUsuario
        );
    }
}

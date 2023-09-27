<?php

declare(strict_types=1);

namespace Src\V2\BoletoInterprovincial\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\BoletoInterprovincial\Domain\Contracts\BoletoInterprovincialRepositoryContract;

final class PuntoVentaUseCase
{
    private BoletoInterprovincialRepositoryContract $repository;

    public function __construct(BoletoInterprovincialRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(

        string $idCliente,
        string $idSede,
        string $idCaja,
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
        string $idParadero,
        float $precio,
        int $idTipoMoneda,
        int $idFormaPago,
        int $obsequio,

        int $idTipoComprobante,
        ?int $idTipoDocumentoEntidad,
        ?string $numeroDocumentoEntidad,
        ?string $nombreEntidad,
        ?string $direccionEntidad,
        string $idUsuarioRegistro
    ): void
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idSede = new Id($idSede,false, 'El id de la sede no tiene el formato correcto');
        $_idCaja = new Id($idCaja,false, 'El id de la caja no tiene el formato correcto');
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
        $_idParadero = new Id($idParadero,false, 'El id del paradero no tiene el formato correcto');
        $_precio = new NumericFloat($precio);
        $_idTipoMoneda = new NumericInteger($idTipoMoneda);
        $_idFormaPago = new NumericInteger($idFormaPago);
        $_obsequio = new NumericInteger($obsequio);

        $_idTipoComprobante = new NumericInteger($idTipoComprobante);
        $_idTipoDocumentoEntidad = new NumericInteger($idTipoDocumentoEntidad);
        $_numeroDocumentoEntidad = new Text($numeroDocumentoEntidad,true, 4, 'El numero de documento de la entidad excede los 4 caracteres');
        $_nombreEntidad = new Text($nombreEntidad,true, -1, '');
        $_direccionEntidad = new Text($direccionEntidad,true, -1, '');

        $_idUsuario = new Id($idUsuarioRegistro,false, 'El id del usuario no tiene el formato correcto');

        $this->repository->puntoVenta(
            $_idCliente,
            $_idSede,
            $_idCaja,
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
            $_idParadero,
            $_precio,
            $_idTipoMoneda,
            $_idFormaPago,
            $_obsequio,

            $_idTipoComprobante,
            $_idTipoDocumentoEntidad,
            $_numeroDocumentoEntidad,
            $_nombreEntidad,
            $_direccionEntidad,

            $_idUsuario
        );
    }
}

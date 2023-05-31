<?php

namespace Src\Administracion\Ingreso\Application;

use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\Ingreso\Domain\Contracts\IngresoRepositoryContract;

final class UpdateUseCase
{
    /**
     * @var IngresoRepositoryContract
     */
    private $repository;

    public function __construct( IngresoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $fecha,
        string $idTipoIngreso,
        ?string $idVehiculo,
        ?string $idPersonal,
        ?string $idRuta,
        string $idCliente,
        float $monto,
        ?string $observacion,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $Id = new Id($id,false,'El id del ingreso no tiene el formato valido');
        $Fecha = new DateOnlyFormat($fecha,false,'La fecha tiene un formato invalido');
        $IdTipoIngreso = new Id($idTipoIngreso,false,'El id del tipo de ingreso no tiene el formato valido');
        $IdVehiculo = new Id($idVehiculo,true,'El id del vehiculo no tiene el formato valido');
        $IdPersonal = new Id($idPersonal,true,'El id del personal no tiene el formato valido');
        $IdRuta = new Id($idRuta,true,'El id de la ruta no tiene el formato valido');
        $IdCliente = new Id($idCliente,false,'El id del cliente no tiene el formato valido');
        $Observacion = new Text($observacion,true, 250,'La observación excede los 250 caracteres');
        $IdEstado = new Numeric($idEstado,false);
        $Monto = new Numeric($monto,false);
        $IdUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario que registro no tiene el formato valido');


        $this->repository->update(
            $Id,
            $Fecha,
            $IdTipoIngreso,
            $IdVehiculo,
            $IdPersonal,
            $IdRuta,
            $Monto,
            $Observacion,
            $IdCliente,
            $IdEstado,
            $IdUsuarioRegistro
        );

    }
}

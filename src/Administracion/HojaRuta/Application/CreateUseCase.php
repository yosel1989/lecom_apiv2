<?php

namespace Src\Administracion\HojaRuta\Application;

use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\HojaRuta\Domain\Contracts\HojaRutaRepositoryContract;
use Src\ModelBase\Domain\ValueObjects\TimeFormat;

final class CreateUseCase
{
    /**
     * @var HojaRutaRepositoryContract
     */
    private $repository;

    public function __construct( HojaRutaRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $idVehiculo,
        string $idPersonal,
        string $idRuta,
        string $fechaAsignada,
        string $horaAsignada,
        string $urlHojaRuta,
        string $idCliente,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $Id = new Id($id,false,'El id de la hoja de ruta no tiene el formato valido');
        $IdVehicle = new Id($idVehiculo,false,'El id del vehiculo no tiene el formato valido');
        $IdPersonal = new Id($idPersonal,false,'El id del personal no tiene el formato valido');
        $IdRoute = new Id($idRuta,false,'El id de la ruta no tiene el formato valido');
        $dateAssign = new DateOnlyFormat($fechaAsignada,true ,'La fecha de asignacion no tiene el formato incorrecto');
        $hourAssign = new TimeFormat($horaAsignada,true ,'La hora de asignacion no tiene el formato incorrecto');
        $urlRouteSheet = new Text($urlHojaRuta,false, 500 ,'La url de la hoja de ruta tiene tiene mas de 500 caracteres');
        $IdClient = new Id($idCliente,false,'El id del cliente no tiene el formato valido');
        $idStatus = new Numeric($idEstado,false);
        $idUserRegistered = new Id($idUsuarioRegistro,false,'El id del usuario que registro no tiene el formato valido');


        $this->repository->create(
            $Id,
            $IdVehicle,
            $IdPersonal,
            $IdRoute,
            $dateAssign,
            $hourAssign,
            $urlRouteSheet,
            $IdClient,
            $idStatus,
            $idUserRegistered
        );

    }
}

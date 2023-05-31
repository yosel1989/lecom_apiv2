<?php

namespace Src\Administracion\HojaRuta\Infraestructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Src\Administracion\HojaRuta\Application\CreateUseCase;
use Src\Administracion\HojaRuta\Infraestructure\Repositories\EloquentHojaRutaRepository;

final class CreateController
{

    /**
     * @var EloquentHojaRutaRepository
     */
    private $repository;

    public function __construct( EloquentHojaRutaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $id         = Uuid::uuid4();
        $idVehicle       = $request->input('idVehiculo');
        $idPersonal       = $request->input('idPersonal');
        $idRuta       = $request->input('idRuta');
        $dateAssigned       = $request->input('fechaAsignada');
        $timeAssigned   = $request->input('horaAsignada');
        $urlRouteSheet   = $request->input('urlHojaRuta');
        $idClient   = $request->input('idCliente');
        $idStatus   = $request->input('idEstado');

        $createHojaRutaCase = new CreateUseCase( $this->repository );
        $createHojaRutaCase->__invoke(
            $id,
            $idVehicle,
            $idPersonal,
            $idRuta,
            $dateAssigned,
            $timeAssigned,
            $urlRouteSheet,
            $idClient,
            $idStatus,
            $user->getId()
        );
    }
}

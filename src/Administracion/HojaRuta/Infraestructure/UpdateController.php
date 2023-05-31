<?php


namespace Src\Administracion\HojaRuta\Infraestructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\Administracion\HojaRuta\Application\UpdateUseCase;
use Src\Administracion\HojaRuta\Infraestructure\Repositories\EloquentHojaRutaRepository;

final class UpdateController
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
        $Id       = $request->id;
        $idVehicle       = $request->input('idVehiculo');
        $idPersonal       = $request->input('idPersonal');
        $idRuta       = $request->input('idRuta');
        $dateAssigned       = $request->input('fechaAsignada');
        $timeAssigned   = $request->input('horaAsignada');
        $urlRouteSheet   = $request->input('urlHojaRuta');
        $idClient   = $request->input('idCliente');
        $idStatus   = $request->input('idEstado');

        $createHojaRutaCase = new UpdateUseCase( $this->repository );
        $createHojaRutaCase->__invoke(
            $Id,
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

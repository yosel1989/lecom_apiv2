<?php


namespace Src\Administracion\Ingreso\Infraestructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\Administracion\Ingreso\Application\UpdateUseCase;
use Src\Administracion\Ingreso\Infraestructure\Repositories\EloquentIngresoRepository;

final class UpdateController
{

    /**
     * @var EloquentIngresoRepository
     */
    private $repository;

    public function __construct( EloquentIngresoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $Id       = $request->id;
        $fecha       = $request->input('fecha');
        $idTipoIngreso       = $request->input('idTipoIngreso');
        $idVehiculo       = $request->input('idVehiculo');
        $idPersonal       = $request->input('idPersonal');
        $idRuta   = $request->input('idRuta');
        $monto   = (float)$request->input('monto');
        $observacion   = (float)$request->input('observacion');
        $idCliente   = (float)$request->input('idCliente');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $Id,
            $fecha,
            $idTipoIngreso,
            $idVehiculo,
            $idPersonal,
            $idRuta,
            $idCliente,
            $monto,
            $observacion,
            1,
            $user->getId()
        );
    }
}

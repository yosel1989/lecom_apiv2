<?php


namespace Src\Administracion\Egreso\Infraestructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\Administracion\Egreso\Application\UpdateUseCase;
use Src\Administracion\Egreso\Infraestructure\Repositories\EloquentEgresoRepository;

final class UpdateController
{

    /**
     * @var EloquentEgresoRepository
     */
    private $repository;

    public function __construct( EloquentEgresoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $Id       = $request->id;
        $fecha       = $request->input('fecha');
        $idTipoEgreso       = $request->input('idTipoEgreso');
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
            $idTipoEgreso,
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
